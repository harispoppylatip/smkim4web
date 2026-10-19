#!/bin/sh
set -e

cd /var/www/html

mkdir -p \
    storage/app/private \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R ug+rwX storage bootstrap/cache 2>/dev/null || true

# Pastikan symlink public/storage aktif
if [ ! -L public/storage ]; then
    echo "[persiapan] membuat symlink public/storage"
    su-exec www-data:www-data php artisan storage:link --force || true
fi

echo "[persiapan] basis data -> host=${DB_HOST:-?} port=${DB_PORT:-?} nama=${DB_DATABASE:-?}"

echo '[persiapan] menunggu basis data siap...'
siap='false'
i=0
while [ "$i" -lt 30 ]; do
    if su-exec www-data:www-data php artisan db:show --json >/dev/null 2>&1; then
        siap='true'
        break
    fi
    i=$((i + 1))
    sleep 2
done

if [ "$siap" != 'true' ]; then
    echo '[persiapan] PERINGATAN: Gagal menghubungi basis data setelah 60 detik.' >&2
else
    echo '[persiapan] basis data terhubung sukses.'
fi

if [ "${RUN_MIGRATIONS:-false}" = "true" ] && [ "$siap" = 'true' ]; then
    echo '[persiapan] menjalankan migrasi database'
    su-exec www-data:www-data php artisan migrate --force || true
fi

if [ "${RUN_SEEDER:-false}" = "true" ] && [ "$siap" = 'true' ]; then
    # Periksa apakah sudah ada data admin di tabel users
    has_admin=$(su-exec www-data:www-data php -r '
        require "vendor/autoload.php";
        $app = require_once "bootstrap/app.php";
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        try {
            echo \App\Models\User::where("role", "admin")->exists() ? "yes" : "no";
        } catch (\Throwable $e) {
            echo "no";
        }
    ' 2>/dev/null || echo "no")

    if [ "$has_admin" != "yes" ]; then
        echo '[persiapan] tabel admin masih kosong, menjalankan DatabaseSeeder...'
        su-exec www-data:www-data php artisan db:seed --force || true
        echo '[persiapan] seeding selesai.'
    fi
fi

if [ "${RUN_OPTIMIZE:-false}" = "true" ]; then
    echo '[persiapan] mengoptimalkan cache konfigurasi dan rute'
    su-exec www-data:www-data php artisan optimize || true
fi

echo "[persiapan] menjalankan $@"
exec "$@"

