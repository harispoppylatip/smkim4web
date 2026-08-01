<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    /**
     * Format tanggal untuk input date picker (Y-m-d).
     * Data lama tersimpan sebagai "24 Okt 2023", date picker butuh "2023-10-24".
     */
    public function getTanggalInputAttribute(): string
    {
        $raw = trim((string) $this->tanggal);
        if ($raw === '') {
            return '';
        }

        // Sudah format Y-m-d
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $raw)) {
            return $raw;
        }

        // Konversi "24 Okt 2023", "21 April 2026", "05 JulI 2026" -> "2023-10-24"
        // (nama bulan penuh & singkatan, case-insensitive)
        $bulan = [
            'januari' => '01', 'jan' => '01', 'februari' => '02', 'feb' => '02',
            'maret' => '03', 'mar' => '03', 'april' => '04', 'apr' => '04',
            'mei' => '05', 'juni' => '06', 'jun' => '06', 'juli' => '07', 'jul' => '07',
            'agustus' => '08', 'agu' => '08', 'september' => '09', 'sep' => '09',
            'oktober' => '10', 'okt' => '10', 'november' => '11', 'nov' => '11',
            'desember' => '12', 'des' => '12',
        ];
        if (preg_match('/^(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})$/', $raw, $m) && isset($bulan[strtolower($m[2])])) {
            return sprintf('%04d-%s-%02d', (int) $m[3], $bulan[strtolower($m[2])], (int) $m[1]);
        }

        // Cadangan: biarkan Carbon mencoba
        try {
            return \Carbon\Carbon::parse($raw)->toDateString();
        } catch (\Throwable $e) {
            return $raw;
        }
    }

    protected $fillable = [
        'slug',
        'judul',
        'kategori',
        'tanggal',
        'deskripsi',
        'konten',
        'icon',
        'gambar',
        'warna',
        'warna_bg',
        'warna_icon',
    ];
}
