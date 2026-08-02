<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakSpmb extends Model
{
    protected $table = 'kontak_spmb';

    protected $fillable = [
        'nama',
        'jenis',
        'nilai',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    /**
     * Daftar jenis kontak yang didukung beserta label tampilannya.
     */
    public static function jenisOptions(): array
    {
        return [
            'whatsapp' => 'WhatsApp',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'tiktok' => 'TikTok',
            'telegram' => 'Telegram',
            'email' => 'Email',
            'telepon' => 'Telepon',
            'website' => 'Website',
            'lainnya' => 'Lainnya',
        ];
    }

    /**
     * Icon Material Symbols untuk setiap jenis kontak.
     */
    public function iconName(): string
    {
        return match ($this->jenis) {
            'whatsapp' => 'chat',
            'instagram' => 'camera',
            'facebook' => 'facebook',
            'tiktok' => 'music_note',
            'telegram' => 'send',
            'email' => 'mail',
            'telepon' => 'call',
            'website' => 'language',
            default => 'link',
        };
    }

    /**
     * Label jenis kontak (mis. "WhatsApp").
     */
    public function jenisLabel(): string
    {
        return self::jenisOptions()[$this->jenis] ?? 'Lainnya';
    }

    /**
     * Bangun URL yang siap diklik (href) berdasarkan jenis kontak.
     * Nilai boleh diisi nomor/username/path, atau URL lengkap (http...).
     */
    public function url(): string
    {
        $nilai = trim($this->nilai);

        // Kalau sudah URL lengkap, langsung pakai.
        if (preg_match('#^https?://#i', $nilai)) {
            return $nilai;
        }

        // Bersihkan nomor WhatsApp: hanya digit (toleransi awalan +).
        $wa = preg_replace('/[^0-9+]/', '', $nilai);

        return match ($this->jenis) {
            'whatsapp' => 'https://wa.me/' . ltrim($wa, '+'),
            'instagram' => 'https://instagram.com/' . ltrim($nilai, '@'),
            'facebook' => 'https://facebook.com/' . ltrim($nilai, '/'),
            'tiktok' => 'https://tiktok.com/@' . ltrim($nilai, '@'),
            'telegram' => 'https://t.me/' . ltrim($nilai, '@'),
            'email' => 'mailto:' . $nilai,
            'telepon' => 'tel:' . $nilai,
            default => 'https://' . $nilai,
        };
    }
}
