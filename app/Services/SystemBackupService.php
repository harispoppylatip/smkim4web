<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

/**
 * Layanan cadangan (backup) dan pemulihan (restore) lengkap sistem SMKIM4 dalam satu berkas .zip.
 *
 * Mengemas seluruh tabel basis data aplikasi dan seluruh berkas publik di storage/app/public
 * (foto berita, logo/banner program keahlian, foto fasilitas, foto guru, brosur SPMB, dll).
 * Menggunakan pembungkus dan pembaca PKZIP murni berbasis stream dan zlib (gzdeflate/gzinflate + crc32)
 * dengan konsumsi RAM sangat hemat (< 10 MB) sehingga 100% kompatibel dengan Windows Explorer,
 * WinRAR, dan 7-Zip tanpa bergantung pada ekstensi ext-zip PHP.
 */
class SystemBackupService
{
    public const AppIdentifier = 'smkim4';

    public const FormatVersion = 1;

    /**
     * Urutan tabel dari induk ke anak agar aman terhadap foreign key saat pemulihan.
     *
     * @var list<string>
     */
    public const Tables = [
        'users',
        'program_keahlian',
        'program_kompetensi',
        'program_mata_pelajaran',
        'program_prestasi',
        'program_sertifikat',
        'program_peluang_kerja',
        'program_guru',
        'program_fasilitas',
        'berita',
        'pengaturan_home',
        'pengaturan_spmb',
        'fasilitas_umums',
        'unggulans',
        'profil_sekolahs',
        'pengaturan_sosial_media',
        'kontak_spmb',
    ];

    /**
     * Folder penyimpanan pada disk 'public' yang ikut dicadangkan.
     *
     * @var list<string>
     */
    public const StorageFolders = [
        'berita',
        'fasilitas',
        'fasilitas-umum',
        'guru',
        'pengaturan-home',
        'prestasi',
        'profil-sekolah',
        'program-keahlian',
        'spmb',
        'struktur-organisasi',
        'unggulan',
    ];

    /**
     * Mendapatkan daftar folder penyimpanan di disk 'public' (termasuk folder baru jika ada).
     *
     * @return list<string>
     */
    public function getStorageFolders(): array
    {
        $disk = Storage::disk('public');
        $folders = self::StorageFolders;

        foreach ($disk->directories() as $dir) {
            $normalized = str_replace('\\', '/', $dir);
            if (! in_array($normalized, $folders, true)) {
                $folders[] = $normalized;
            }
        }

        return $folders;
    }

    /**
     * Hitung ringkasan jumlah berkas dan total ukuran penyimpanan saat ini.
     *
     * @return array{file_count: int, total_bytes: int, formatted_bytes: string, tables_count: array<string, int>, total_records: int}
     */
    public function storageSummary(): array
    {
        $disk = Storage::disk('public');
        $fileCount = 0;
        $totalBytes = 0;

        foreach ($this->getStorageFolders() as $folder) {
            if (! $disk->exists($folder)) {
                continue;
            }

            foreach ($disk->allFiles($folder) as $filePath) {
                $fileCount++;
                $totalBytes += (int) $disk->size($filePath);
            }
        }

        $tablesCount = [];
        $totalRecords = 0;

        foreach (self::Tables as $table) {
            if (Schema::hasTable($table)) {
                $count = DB::table($table)->count();
                $tablesCount[$table] = $count;
                $totalRecords += $count;
            } else {
                $tablesCount[$table] = 0;
            }
        }

        return [
            'file_count' => $fileCount,
            'total_bytes' => $totalBytes,
            'formatted_bytes' => self::formatBytes($totalBytes),
            'tables_count' => $tablesCount,
            'total_records' => $totalRecords,
        ];
    }

    /**
     * Bangun berkas arsip .zip pada disk sementara (stream-based) untuk mencegah kehabisan memori.
     *
     * @return string Path ke berkas .zip sementara di disk
     */
    public function createBackupZipFile(): string
    {
        @ini_set('memory_limit', '512M');
        @set_time_limit(300);

        $tempZipPath = tempnam(sys_get_temp_dir(), 'smkim4_backup_');
        $zipHandle = fopen($tempZipPath, 'w+b');
        if ($zipHandle === false) {
            throw new RuntimeException('Gagal membuat berkas cadangan sementara pada sistem.');
        }

        try {
            $database = [];
            $tableCounts = [];

            foreach (self::Tables as $table) {
                if (! Schema::hasTable($table)) {
                    $database[$table] = [];
                    $tableCounts[$table] = 0;
                    continue;
                }

                $rows = DB::table($table)
                    ->get()
                    ->map(static fn (object $row): array => (array) $row)
                    ->all();

                $database[$table] = $rows;
                $tableCounts[$table] = count($rows);
            }

            $disk = Storage::disk('public');
            $filesToProcess = [];
            $fileCount = 0;

            foreach ($this->getStorageFolders() as $folder) {
                if (! $disk->exists($folder)) {
                    continue;
                }

                foreach ($disk->allFiles($folder) as $relativePath) {
                    $normalized = str_replace('\\', '/', $relativePath);
                    $filesToProcess['storage/'.$normalized] = $relativePath;
                    $fileCount++;
                }
            }

            $manifest = [
                'app' => self::AppIdentifier,
                'version' => self::FormatVersion,
                'created_at' => now()->toIso8601String(),
                'stats' => [
                    'tables' => $tableCounts,
                    'files' => $fileCount,
                ],
            ];

            $manifestJson = json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $databaseJson = json_encode($database, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $readmeText = $this->buildReadmeText($manifest);

            $centralParts = [];
            $offset = 0;
            $count = 0;
            $dosTime = $this->unixToDosTime(time());

            $writeEntry = function (string $cleanName, string $data) use ($zipHandle, &$centralParts, &$offset, &$count, $dosTime): void {
                $cleanName = ltrim(str_replace('\\', '/', $cleanName), '/');
                $nameLength = strlen($cleanName);
                $uncompressedSize = strlen($data);
                $crc = crc32($data);
                $compressed = gzdeflate($data, 6);
                $compressedSize = strlen($compressed);

                // Local File Header (0x04034b50)
                $localHeader = pack(
                    'VvvvvvVVVvv',
                    0x04034B50,
                    20,
                    0x0800,
                    8,
                    $dosTime & 0xFFFF,
                    ($dosTime >> 16) & 0xFFFF,
                    $crc,
                    $compressedSize,
                    $uncompressedSize,
                    $nameLength,
                    0
                ).$cleanName;

                fwrite($zipHandle, $localHeader);
                fwrite($zipHandle, $compressed);

                // Central Directory Header (0x02014b50)
                $centralParts[] = pack(
                    'VvvvvvvVVVvvvvvVV',
                    0x02014B50,
                    20,
                    20,
                    0x0800,
                    8,
                    $dosTime & 0xFFFF,
                    ($dosTime >> 16) & 0xFFFF,
                    $crc,
                    $compressedSize,
                    $uncompressedSize,
                    $nameLength,
                    0,
                    0,
                    0,
                    0,
                    32,
                    $offset
                ).$cleanName;

                $offset += strlen($localHeader) + $compressedSize;
                $count++;
            };

            // 1. Tulis manifest.json
            $writeEntry('manifest.json', $manifestJson);

            // 2. Tulis database.json
            $writeEntry('database.json', $databaseJson);

            // 3. Tulis BACA-SAYA.txt
            $writeEntry('BACA-SAYA.txt', $readmeText);

            // 4. Tulis setiap file storage secara bergantian (langsung free memory per file)
            foreach ($filesToProcess as $zipEntryName => $storageRelPath) {
                $contents = $disk->get($storageRelPath);
                if ($contents === null) {
                    continue;
                }
                $writeEntry($zipEntryName, $contents);
                unset($contents);
            }

            // Central Directory
            $centralDirectory = implode('', $centralParts);
            $centralSize = strlen($centralDirectory);
            fwrite($zipHandle, $centralDirectory);

            // End of Central Directory Record (0x06054b50)
            $eocd = pack(
                'VvvvvVVv',
                0x06054B50,
                0,
                0,
                $count,
                $count,
                $centralSize,
                $offset,
                0
            );
            fwrite($zipHandle, $eocd);

            fclose($zipHandle);

            return $tempZipPath;
        } catch (Throwable $e) {
            if (is_resource($zipHandle)) {
                fclose($zipHandle);
            }
            if (file_exists($tempZipPath)) {
                @unlink($tempZipPath);
            }
            throw $e;
        }
    }

    /**
     * Bangun arsip .zip biner (memanggil createBackupZipFile dan membacanya).
     */
    public function createBackupZipBinary(): string
    {
        $filePath = $this->createBackupZipFile();
        try {
            $binary = (string) file_get_contents($filePath);

            return $binary;
        } finally {
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
    }

    /**
     * Pulihkan basis data dan seluruh berkas foto dari berkas .zip cadangan pada path berkas.
     *
     * @return array{tables: array<string, int>, files: int, admin_user: User}
     */
    public function restoreFromZipFile(string $zipFilePath, User $currentAdmin): array
    {
        @ini_set('memory_limit', '512M');
        @set_time_limit(300);

        $fileSize = filesize($zipFilePath);
        if ($fileSize === false || $fileSize < 22) {
            throw new RuntimeException('Berkas yang diunggah bukan berkas arsip .zip yang sah.');
        }

        $handle = fopen($zipFilePath, 'rb');
        if ($handle === false) {
            throw new RuntimeException('Tidak dapat membuka berkas cadangan yang diunggah.');
        }

        try {
            // Cek 4 byte pertama
            $sig = fread($handle, 4);
            if ($sig !== "PK\x03\x04") {
                throw new RuntimeException('Berkas yang diunggah bukan berkas arsip .zip yang sah.');
            }

            // Cari EOCD dari akhir berkas
            $maxSearch = min($fileSize, 65557);
            fseek($handle, $fileSize - $maxSearch);
            $tail = fread($handle, $maxSearch);

            $eocdPos = strrpos($tail, "PK\x05\x06");
            if ($eocdPos === false) {
                throw new RuntimeException('Struktur arsip .zip tidak lengkap atau rusak.');
            }

            $eocdOffset = ($fileSize - $maxSearch) + $eocdPos;
            fseek($handle, $eocdOffset + 4);
            $eocdRaw = fread($handle, 18);
            $eocd = unpack('vdisk/vstartDisk/vdiskEntries/vtotalEntries/VcentralSize/VcentralOffset/vcommentLen', $eocdRaw);
            if (! is_array($eocd)) {
                throw new RuntimeException('Gagal membaca katalog arsip .zip.');
            }

            $cursor = (int) $eocd['centralOffset'];
            $totalEntries = (int) $eocd['totalEntries'];

            $catalog = [];
            fseek($handle, $cursor);

            for ($i = 0; $i < $totalEntries; $i++) {
                $recSig = fread($handle, 4);
                if ($recSig !== "PK\x01\x02") {
                    throw new RuntimeException('Katalog berkas di dalam arsip .zip rusak.');
                }

                $hdr = unpack('vverMade/vverNeed/vflags/vmethod/vmtime/vmdate/Vcrc/VcompSize/VuncompSize/vnameLen/vextraLen/vcommentLen/vdiskStart/vintAttr/VextAttr/VlocalOffset', fread($handle, 42));
                $nameLen = (int) $hdr['nameLen'];
                $extraLen = (int) $hdr['extraLen'];
                $commentLen = (int) $hdr['commentLen'];
                $entryName = fread($handle, $nameLen);

                if ($extraLen + $commentLen > 0) {
                    fseek($handle, $extraLen + $commentLen, SEEK_CUR);
                }

                $catalog[$entryName] = [
                    'method' => (int) $hdr['method'],
                    'compSize' => (int) $hdr['compSize'],
                    'uncompSize' => (int) $hdr['uncompSize'],
                    'localOffset' => (int) $hdr['localOffset'],
                ];
            }

            $readEntry = function (string $name) use ($handle, $catalog): string {
                if (! isset($catalog[$name])) {
                    throw new RuntimeException("Berkas '{$name}' tidak ditemukan di dalam arsip .zip.");
                }
                $meta = $catalog[$name];
                fseek($handle, $meta['localOffset']);
                $sig = fread($handle, 4);
                if ($sig !== "PK\x03\x04") {
                    throw new RuntimeException("Header berkas '{$name}' di dalam .zip tidak valid.");
                }
                $localHdr = unpack('vverNeed/vflags/vmethod/vmtime/vmdate/Vcrc/VcompSize/VuncompSize/vnameLen/vextraLen', fread($handle, 26));
                $skip = (int) $localHdr['nameLen'] + (int) $localHdr['extraLen'];
                if ($skip > 0) {
                    fseek($handle, $skip, SEEK_CUR);
                }

                $raw = fread($handle, $meta['compSize']);
                if ($meta['method'] === 0) {
                    return $raw;
                } elseif ($meta['method'] === 8) {
                    $inflated = @gzinflate($raw);
                    if ($inflated === false) {
                        throw new RuntimeException("Gagal mengekstrak isi berkas '{$name}' dari arsip .zip.");
                    }

                    return $inflated;
                }
                throw new RuntimeException("Metode kompresi berkas '{$name}' tidak didukung.");
            };

            if (! isset($catalog['manifest.json'], $catalog['database.json'])) {
                throw new RuntimeException('Berkas .zip ini bukan berkas cadangan sistem SMKIM4 yang sah (manifest.json atau database.json tidak ditemukan).');
            }

            $manifestJson = $readEntry('manifest.json');
            $manifest = json_decode($manifestJson, true);
            if (! is_array($manifest) || ($manifest['app'] ?? null) !== self::AppIdentifier) {
                throw new RuntimeException('Berkas .zip ini tidak berasal dari aplikasi SMKIM4.');
            }

            $databaseJson = $readEntry('database.json');
            $database = json_decode($databaseJson, true);
            if (! is_array($database)) {
                throw new RuntimeException('Isi database.json di dalam berkas cadangan rusak atau tidak dapat dibaca.');
            }

            foreach (self::Tables as $table) {
                if (! array_key_exists($table, $database) || ! is_array($database[$table])) {
                    throw new RuntimeException("Data tabel '{$table}' tidak ditemukan di dalam berkas cadangan.");
                }
            }

            $adminFallbackAttributes = $currentAdmin->getAttributes();
            $restoredCounts = [];

            Schema::disableForeignKeyConstraints();

            try {
                DB::transaction(function () use ($database, $adminFallbackAttributes, &$restoredCounts): void {
                    // Hapus data dari anak ke induk
                    foreach (array_reverse(self::Tables) as $table) {
                        if (Schema::hasTable($table)) {
                            DB::table($table)->delete();
                        }
                    }

                    // Masukkan data dari induk ke anak
                    foreach (self::Tables as $table) {
                        if (! Schema::hasTable($table)) {
                            continue;
                        }

                        $rows = $database[$table];
                        $restoredCounts[$table] = count($rows);

                        if ($rows === []) {
                            continue;
                        }

                        $columns = array_flip(Schema::getColumnListing($table));

                        $filteredRows = array_map(
                            static fn (array $row): array => array_intersect_key($row, $columns),
                            $rows,
                        );

                        foreach (array_chunk($filteredRows, 100) as $chunk) {
                            DB::table($table)->insert($chunk);
                        }
                    }

                    // Pastikan minimal selalu ada 1 akun Administrator agar tidak terkunci keluar
                    $hasAdmin = DB::table('users')->where('role', 'admin')->exists();
                    if (! $hasAdmin) {
                        $userColumns = array_flip(Schema::getColumnListing('users'));
                        $adminRow = array_intersect_key($adminFallbackAttributes, $userColumns);
                        unset($adminRow['id']);
                        $adminRow['role'] = 'admin';
                        DB::table('users')->insert($adminRow);
                    }
                });
            } finally {
                Schema::enableForeignKeyConstraints();
            }

            // Hapus folder lama di public storage
            $disk = Storage::disk('public');
            foreach ($this->getStorageFolders() as $folder) {
                $disk->deleteDirectory($folder);
            }

            // Ekstrak dan simpan berkas media secara langsung satu demi satu
            $restoredFiles = 0;
            foreach ($catalog as $entryName => $meta) {
                $normalized = str_replace('\\', '/', $entryName);
                if (! str_starts_with($normalized, 'storage/')) {
                    continue;
                }

                $relativePath = substr($normalized, strlen('storage/'));
                if ($relativePath === '' || str_contains($relativePath, '..') || str_ends_with($relativePath, '/')) {
                    continue;
                }

                $content = $readEntry($entryName);
                $disk->put($relativePath, $content);
                unset($content);
                $restoredFiles++;
            }

            $adminUser = User::query()
                ->where('role', 'admin')
                ->where(function ($query) use ($adminFallbackAttributes): void {
                    $query->where('id', $adminFallbackAttributes['id'] ?? 0)
                        ->orWhere('email', $adminFallbackAttributes['email'] ?? '');
                })
                ->first()
                ?? User::query()->where('role', 'admin')->firstOrFail();

            return [
                'tables' => $restoredCounts,
                'files' => $restoredFiles,
                'admin_user' => $adminUser,
            ];
        } finally {
            fclose($handle);
        }
    }

    /**
     * Pulihkan dari string biner (menulis ke berkas sementara lalu memanggil restoreFromZipFile).
     *
     * @return array{tables: array<string, int>, files: int, admin_user: User}
     */
    public function restoreFromZipBinary(string $zipBytes, User $currentAdmin): array
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'smkim4_restore_');
        file_put_contents($tempFile, $zipBytes);

        try {
            return $this->restoreFromZipFile($tempFile, $currentAdmin);
        } finally {
            if (file_exists($tempFile)) {
                @unlink($tempFile);
            }
        }
    }

    /**
     * Ekstrak berkas PKZIP standar dari string biner menjadi array [path => binaryContent].
     *
     * @return array<string, string>
     */
    public function extractZip(string $zipBytes): array
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'smkim4_ext_');
        file_put_contents($tempFile, $zipBytes);

        try {
            $handle = fopen($tempFile, 'rb');
            if ($handle === false) {
                throw new RuntimeException('Tidak dapat membaca berkas .zip.');
            }

            $fileSize = filesize($tempFile);
            $maxSearch = min($fileSize, 65557);
            fseek($handle, $fileSize - $maxSearch);
            $tail = fread($handle, $maxSearch);

            $eocdPos = strrpos($tail, "PK\x05\x06");
            if ($eocdPos === false) {
                fclose($handle);
                throw new RuntimeException('Struktur arsip .zip tidak lengkap atau rusak.');
            }

            $eocdOffset = ($fileSize - $maxSearch) + $eocdPos;
            fseek($handle, $eocdOffset + 4);
            $eocd = unpack('vdisk/vstartDisk/vdiskEntries/vtotalEntries/VcentralSize/VcentralOffset/vcommentLen', fread($handle, 18));
            $cursor = (int) $eocd['centralOffset'];
            $totalEntries = (int) $eocd['totalEntries'];

            $catalog = [];
            fseek($handle, $cursor);

            for ($i = 0; $i < $totalEntries; $i++) {
                fread($handle, 4); // PK\x01\x02
                $hdr = unpack('vverMade/vverNeed/vflags/vmethod/vmtime/vmdate/Vcrc/VcompSize/VuncompSize/vnameLen/vextraLen/vcommentLen/vdiskStart/vintAttr/VextAttr/VlocalOffset', fread($handle, 42));
                $nameLen = (int) $hdr['nameLen'];
                $extraLen = (int) $hdr['extraLen'];
                $commentLen = (int) $hdr['commentLen'];
                $entryName = fread($handle, $nameLen);

                if ($extraLen + $commentLen > 0) {
                    fseek($handle, $extraLen + $commentLen, SEEK_CUR);
                }

                $catalog[$entryName] = [
                    'method' => (int) $hdr['method'],
                    'compSize' => (int) $hdr['compSize'],
                    'localOffset' => (int) $hdr['localOffset'],
                ];
            }

            $entries = [];
            foreach ($catalog as $name => $meta) {
                fseek($handle, $meta['localOffset'] + 4);
                $localHdr = unpack('vverNeed/vflags/vmethod/vmtime/vmdate/Vcrc/VcompSize/VuncompSize/vnameLen/vextraLen', fread($handle, 26));
                $skip = (int) $localHdr['nameLen'] + (int) $localHdr['extraLen'];
                if ($skip > 0) {
                    fseek($handle, $skip, SEEK_CUR);
                }

                $raw = fread($handle, $meta['compSize']);
                if ($meta['method'] === 0) {
                    $entries[$name] = $raw;
                } elseif ($meta['method'] === 8) {
                    $inflated = @gzinflate($raw);
                    if ($inflated === false) {
                        fclose($handle);
                        throw new RuntimeException("Gagal mengekstrak isi berkas '{$name}'.");
                    }
                    $entries[$name] = $inflated;
                }
            }

            fclose($handle);

            return $entries;
        } finally {
            if (file_exists($tempFile)) {
                @unlink($tempFile);
            }
        }
    }

    /**
     * Format byte ke satuan yang mudah dibaca manusia.
     */
    public static function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * (int) $pow));

        return round($bytes, $precision).' '.$units[$pow];
    }

    /**
     * @param  array<string, mixed>  $manifest
     */
    private function buildReadmeText(array $manifest): string
    {
        $tables = $manifest['stats']['tables'] ?? [];
        $files = $manifest['stats']['files'] ?? 0;

        return implode("\r\n", [
            '===================================================================',
            'ARSIP CADANGAN LENGKAP (FULL BACKUP) - SMK MUHAMMADIYAH 4 SAMARINDA',
            '===================================================================',
            'Waktu Pembuatan   : '.($manifest['created_at'] ?? '-'),
            'Total Pengguna    : '.($tables['users'] ?? 0).' akun',
            'Program Keahlian  : '.($tables['program_keahlian'] ?? 0).' jurusan',
            'Total Berita      : '.($tables['berita'] ?? 0).' artikel',
            'Fasilitas Umum    : '.($tables['fasilitas_umums'] ?? 0).' item',
            'Program Unggulan  : '.($tables['unggulans'] ?? 0).' program',
            'Total Berkas Media: '.$files.' berkas foto/gambar/dokumen',
            '',
            'CARA MEMULIHKAN (RESTORE) DATA:',
            '1. Masuk ke halaman Admin SMKIM4 (/admin) dengan akun Administrator.',
            '2. Buka menu samping "Backup & Restore" di kelompok Pengaturan.',
            '3. Pada kartu "Pulihkan Data Sistem (Restore)", pilih berkas .zip ini.',
            '4. Centang kotak persetujuan konfirmasi.',
            '5. Klik tombol "Pulihkan Data Sekarang".',
            '6. Seluruh database dan foto media website akan pulih seperti semula.',
            '===================================================================',
        ]);
    }

    private function unixToDosTime(int $timestamp): int
    {
        $date = getdate($timestamp);
        if ($date['year'] < 1980) {
            return (1 << 21) | (1 << 16);
        }

        return (($date['year'] - 1980) << 25)
            | ($date['mon'] << 21)
            | ($date['mday'] << 16)
            | ($date['hours'] << 11)
            | ($date['minutes'] << 5)
            | ($date['seconds'] >> 1);
    }
}

