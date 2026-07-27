<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $berita = [
            [
                'slug' => 'implementasi-fiber-optic-lab-tkjt-1',
                'judul' => 'Implementasi Fiber Optic pada Lab TKJT 1',
                'kategori' => 'TKJT',
                'tanggal' => '24 Okt 2023',
                'deskripsi' => 'Peningkatan infrastruktur laboratorium komputer dan jaringan telekomunikasi dengan teknologi fiber optic terbaru untuk menunjang kompetensi siswa di era digital.',
                'konten' => '<p>SMK Istiqomah Muhammadiyah 4 Samarinda terus berkomitmen untuk meningkatkan kualitas pembelajaran siswa, khususnya pada jurusan Teknik Komputer dan Jaringan Telekomunikasi (TKJT). Kali ini, sekolah menghadirkan pembaruan signifikan pada laboratorium TKJT 1 dengan implementasi teknologi <strong>Fiber Optic</strong>.</p>

                <p>Teknologi fiber optic dipilih karena kemampuannya dalam mentransmisikan data dengan kecepatan tinggi dan stabilitas yang lebih baik dibandingkan kabel tembaga konvensional. Dengan adanya infrastruktur ini, siswa dapat belajar tentang jaringan modern yang banyak digunakan di industri telekomunikasi saat ini.</p>

                <h3 class="font-heading text-xl font-bold text-primary mt-lg mb-md">Tujuan Implementasi</h3>
                <ul class="list-disc pl-lg space-y-sm text-on-surface-variant">
                    <li>Meningkatkan kompetensi siswa dalam bidang jaringan fiber optic</li>
                    <li>Menyediakan fasilitas laboratorium yang sesuai dengan standar industri</li>
                    <li>Mempersiapkan siswa untuk menghadapi tantangan di era digital</li>
                    <li>Mendukung kurikulum berbasis industri 4.0</li>
                </ul>

                <p class="mt-lg">Dengan adanya laboratorium fiber optic ini, diharapkan siswa TKJT dapat bersaing di dunia kerja dan melanjutkan pendidikan ke jenjang yang lebih tinggi dengan bekal keterampilan yang relevan.</p>',
                'icon' => 'lan',
                'warna' => 'primary',
                'warna_bg' => 'primary/20',
                'warna_icon' => 'primary/30',
            ],
            [
                'slug' => 'workshop-desain-karakter-tipografi',
                'judul' => 'Workshop Desain Karakter & Tipografi',
                'kategori' => 'DKV',
                'tanggal' => '26 Okt 2023',
                'deskripsi' => 'Menghadirkan praktisi industri untuk mengasah kreativitas siswa DKV dalam menciptakan aset visual yang ikonik.',
                'konten' => '<p>Jurusan Desain Komunikasi Visual (DKV) SMK Istiqomah Muhammadiyah 4 Samarinda sukses menggelar workshop bertema "Desain Karakter &amp; Tipografi" yang menghadirkan praktisi industri kreatif ternama.</p>

                <p>Workshop ini bertujuan untuk memberikan wawasan dan pengalaman langsung kepada siswa tentang proses kreatif dalam menciptakan desain karakter yang ikonik serta pemahaman mendalam tentang tipografi sebagai elemen penting dalam desain grafis.</p>

                <h3 class="font-heading text-xl font-bold text-primary mt-lg mb-md">Materi Workshop</h3>
                <ul class="list-disc pl-lg space-y-sm text-on-surface-variant">
                    <li>Dasar-dasar desain karakter</li>
                    <li>Teknik tipografi modern</li>
                    <li>Penggunaan software desain profesional</li>
                    <li>Portofolio dan branding diri</li>
                </ul>

                <p class="mt-lg">Para siswa sangat antusias mengikuti workshop ini dan berharap kegiatan serupa dapat diadakan secara rutin untuk mengembangkan bakat dan keterampilan mereka di bidang desain.</p>',
                'icon' => 'palette',
                'warna' => 'secondary',
                'warna_bg' => 'secondary-container/20',
                'warna_icon' => 'secondary-container/40',
            ],
            [
                'slug' => 'kajian-rutin-jumat-berkah',
                'judul' => 'Kajian Rutin Jumat Berkah',
                'kategori' => 'General',
                'tanggal' => '28 Okt 2023',
                'deskripsi' => 'Memperkuat karakter spiritual siswa melalui kajian mingguan yang inspiratif dan edukatif.',
                'konten' => '<p>Kegiatan Kajian Rutin Jumat Berkah kembali digelar di SMK Istiqomah Muhammadiyah 4 Samarinda. Kegiatan ini merupakan program mingguan yang bertujuan untuk memperkuat karakter spiritual siswa.</p>

                <p>Kajian kali ini menghadirkan ustazd inspiratif yang membahas tema "Pemuda Berprestasi, Akhlak Mulia". Para siswa diajak untuk merenungkan pentingnya menyeimbangkan antara prestasi akademik dan akhlak mulia dalam kehidupan sehari-hari.</p>

                <h3 class="font-heading text-xl font-bold text-primary mt-lg mb-md">Manfaat Kegiatan</h3>
                <ul class="list-disc pl-lg space-y-sm text-on-surface-variant">
                    <li>Meningkatkan keimanan dan ketakwaan siswa</li>
                    <li>Membangun karakter islami yang kuat</li>
                    <li>Mempererat ukhuwah islamiyah antar siswa</li>
                    <li>Memberikan motivasi dan inspirasi</li>
                </ul>

                <p class="mt-lg">Kegiatan ini mendapat sambutan positif dari siswa dan guru, dan diharapkan dapat terus berlangsung secara konsisten setiap pekannya.</p>',
                'icon' => 'groups',
                'warna' => 'outline',
                'warna_bg' => 'tertiary-container/20',
                'warna_icon' => 'tertiary-container/40',
            ],
            [
                'slug' => 'pelatihan-cyber-security-tkjt',
                'judul' => 'Pelatihan Cyber Security untuk Siswa TKJT',
                'kategori' => 'TKJT',
                'tanggal' => '15 Nov 2023',
                'deskripsi' => 'Siswa TKJT mengikuti pelatihan keamanan siber bersama praktisi IT profesional.',
                'konten' => '<p>Dalam era digital yang semakin maju, keamanan siber menjadi salah satu keterampilan yang sangat penting. SMK Istiqomah Muhammadiyah 4 Samarinda melalui jurusan TKJT mengadakan pelatihan cyber security bagi siswa-siswinya.</p>

                <p>Pelatihan ini menghadirkan praktisi IT profesional yang berpengalaman di bidang keamanan jaringan. Para siswa mendapatkan pengetahuan tentang berbagai ancaman siber dan cara mengatasinya.</p>

                <h3 class="font-heading text-xl font-bold text-primary mt-lg mb-md">Topik Pelatihan</h3>
                <ul class="list-disc pl-lg space-y-sm text-on-surface-variant">
                    <li>Pengenalan cyber security</li>
                    <li>Teknik penetrasi testing dasar</li>
                    <li>Keamanan jaringan dan firewall</li>
                    <li>Etika dalam keamanan siber</li>
                </ul>

                <p class="mt-lg">Dengan pelatihan ini, siswa TKJT diharapkan memiliki kesadaran dan keterampilan dasar dalam menjaga keamanan sistem dan jaringan.</p>',
                'icon' => 'security',
                'warna' => 'primary',
                'warna_bg' => 'primary/20',
                'warna_icon' => 'primary/30',
            ],
            [
                'slug' => 'pameran-fotografi-digital-dkv-2023',
                'judul' => 'Pameran Fotografi Digital DKV 2023',
                'kategori' => 'DKV',
                'tanggal' => '20 Nov 2023',
                'deskripsi' => 'Karya terbaik siswa DKV dipamerkan dalam gelaran pameran fotografi tahunan.',
                'konten' => '<p>Jurusan Desain Komunikasi Visual (DKV) SMK Istiqomah Muhammadiyah 4 Samarinda menggelar Pameran Fotografi Digital 2023. Acara ini menampilkan karya-karya terbaik siswa dalam bidang fotografi digital.</p>

                <p>Pameran tahunan ini menjadi ajang bagi siswa untuk menampilkan kreativitas dan keterampilan teknis mereka dalam mengabadikan momen melalui lensa kamera. Berbagai tema diangkat, mulai dari potret, landscape, hingga fotografi produk.</p>

                <h3 class="font-heading text-xl font-bold text-primary mt-lg mb-md">Kategori Lomba</h3>
                <ul class="list-disc pl-lg space-y-sm text-on-surface-variant">
                    <li>Fotografi potret</li>
                    <li>Fotografi landscape</li>
                    <li>Fotografi produk</li>
                    <li>Fotografi jurnalistik</li>
                </ul>

                <p class="mt-lg">Pameran ini mendapat apresiasi dari berbagai pihak dan menjadi bukti nyata perkembangan bakat siswa DKV di bidang fotografi.</p>',
                'icon' => 'photo_camera',
                'warna' => 'secondary',
                'warna_bg' => 'secondary-container/20',
                'warna_icon' => 'secondary-container/40',
            ],
            [
                'slug' => 'peringatan-hari-guru-nasional',
                'judul' => 'Peringatan Hari Guru Nasional',
                'kategori' => 'General',
                'tanggal' => '25 Nov 2023',
                'deskripsi' => 'Kemeriahan peringatan Hari Guru di SMK Istiqomah dengan berbagai lomba dan penghargaan.',
                'konten' => '<p>SMK Istiqomah Muhammadiyah 4 Samarinda merayakan Hari Guru Nasional dengan penuh kemeriahan. Berbagai acara dan lomba digelar untuk menghormati jasa para guru yang telah mendidik dan membimbing siswa.</p>

                <p>Acara puncak peringatan Hari Guru diisi dengan pemberian penghargaan kepada guru-guru berprestasi, serta penampilan seni dari siswa-siswi yang menghibur seluruh hadirin.</p>

                <h3 class="font-heading text-xl font-bold text-primary mt-lg mb-md">Rangkaian Acara</h3>
                <ul class="list-disc pl-lg space-y-sm text-on-surface-variant">
                    <li>Upacara peringatan Hari Guru</li>
                    <li>Pemberian penghargaan guru berprestasi</li>
                    <li>Pentas seni dari siswa</li>
                    <li>Lomba antar kelas</li>
                </ul>

                <p class="mt-lg">Semoga semangat dan dedikasi para guru terus menginspirasi generasi muda untuk meraih prestasi.</p>',
                'icon' => 'celebration',
                'warna' => 'outline',
                'warna_bg' => 'tertiary-container/20',
                'warna_icon' => 'tertiary-container/40',
            ],
        ];

        foreach ($berita as $item) {
            \App\Models\Berita::create($item);
        }
    }
}
