<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TKJT
        $tkjt = \App\Models\ProgramKeahlian::create([
            'slug' => 'tkjt',
            'singkatan' => 'TKJT',
            'nama' => 'Teknik Komputer Jaringan & Telekomunikasi',
            'deskripsi_singkat' => 'Pelajari arsitektur jaringan modern, manajemen server enterprise, dan instalasi perangkat keras telekomunikasi tercanggih.',
            'deskripsi' => '<p>Jurusan Teknik Komputer Jaringan &amp; Telekomunikasi (TKJT) adalah program keahlian yang berfokus pada penguasaan teknologi jaringan komputer, sistem telekomunikasi, dan infrastruktur IT modern. Siswa dibekali keterampilan mulai dari instalasi perangkat keras, konfigurasi jaringan, hingga keamanan siber.</p>
                <p>Dengan kurikulum yang diselaraskan dengan kebutuhan industri, lulusan TKJT siap bersaing di dunia kerja sebagai teknisi jaringan, administrator server, atau spesialis keamanan IT. Pembelajaran dilakukan di laboratorium modern dengan peralatan standar industri.</p>',
            'icon' => 'lan',
            'icon_besar' => 'dns',
            'warna' => 'primary',
            'warna_bg' => 'primary/20',
            'warna_icon' => 'primary/30',
            'warna_container' => 'primary',
            'warna_container_bg' => 'primary/10',
        ]);

        // TKJT - Kompetensi
        $tkjtKompetensi = ['MikroTik & Cisco', 'Cloud Server', 'Cyber Security', 'Hardware Repair', 'Fiber Optic', 'Linux Administrator'];
        foreach ($tkjtKompetensi as $i => $item) {
            $tkjt->kompetensi()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TKJT - Mata Pelajaran
        $tkjtMapel = ['Komputer dan Jaringan Dasar', 'Sistem Operasi', 'Administrasi Server', 'Teknologi Jaringan Berbasis Luas (WAN)', 'Keamanan Jaringan', 'Produk Kreatif dan Kewirausahaan'];
        foreach ($tkjtMapel as $i => $item) {
            $tkjt->mataPelajaran()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TKJT - Prestasi
        $tkjtPrestasi = [
            ['tahun' => '2023', 'judul' => 'Juara 1 Lomba Network Configuration Tingkat Provinsi', 'deskripsi' => 'Tim TKJT berhasil meraih juara pertama dalam kompetisi konfigurasi jaringan yang diselenggarakan oleh Dinas Pendidikan Kaltim.', 'icon' => 'emoji_events'],
            ['tahun' => '2023', 'judul' => 'Juara 2 Cyber Security Competition', 'deskripsi' => 'Siswa TKJT meraih juara kedua dalam kompetisi keamanan siber antar SMK se-Kalimantan Timur.', 'icon' => 'security'],
            ['tahun' => '2022', 'judul' => 'Finalis LKS IT Network Systems Administration', 'deskripsi' => 'Mewakili Kalimantan Timur di ajang Lomba Kompetensi Siswa Nasional bidang IT Network Systems Administration.', 'icon' => 'lan'],
        ];
        foreach ($tkjtPrestasi as $i => $item) {
            $tkjt->prestasi()->create($item + ['urutan' => $i]);
        }

        // TKJT - Sertifikat
        $tkjtSertifikat = [
            ['nama' => 'MikroTik Certified Network Associate (MTCNA)', 'penyelenggara' => 'MikroTik', 'deskripsi' => 'Sertifikasi internasional untuk ahli jaringan MikroTik yang diakui secara global.', 'icon' => 'router'],
            ['nama' => 'Cisco Certified Network Associate (CCNA)', 'penyelenggara' => 'Cisco Systems', 'deskripsi' => 'Sertifikasi fundamental jaringan Cisco yang menjadi standar industri telekomunikasi.', 'icon' => 'settings_ethernet'],
            ['nama' => 'BNSP Teknisi Jaringan', 'penyelenggara' => 'BNSP', 'deskripsi' => 'Sertifikasi kompetensi nasional untuk teknisi jaringan komputer tingkat madya.', 'icon' => 'verified'],
        ];
        foreach ($tkjtSertifikat as $i => $item) {
            $tkjt->sertifikat()->create($item + ['urutan' => $i]);
        }

        // TKJT - Peluang Kerja
        $tkjtKarir = ['Network Engineer', 'IT Support Specialist', 'System Administrator', 'Cyber Security Analyst', 'Teknisi Fiber Optic', 'Cloud Engineer'];
        foreach ($tkjtKarir as $i => $item) {
            $tkjt->peluangKerja()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TKJT - Guru
        $tkjtGuru = [
            ['nama' => 'Ahmad Syarif, S.Kom.', 'bidang' => 'Jaringan Komputer'],
            ['nama' => 'Budi Hartono, M.T.', 'bidang' => 'Sistem Operasi & Server'],
            ['nama' => 'Citra Dewi, S.T.', 'bidang' => 'Keamanan Jaringan'],
            ['nama' => 'Doni Prasetyo, S.Kom.', 'bidang' => 'Pemrograman Dasar'],
        ];
        foreach ($tkjtGuru as $i => $item) {
            $tkjt->guru()->create($item + ['urutan' => $i]);
        }

        // TKJT - Fasilitas
        $tkjtFasilitas = [
            ['nama' => 'Lab TKJT 1', 'deskripsi' => 'Laboratorium jaringan dengan 30 PC dan perangkat Cisco', 'icon' => 'computer'],
            ['nama' => 'Lab TKJT 2', 'deskripsi' => 'Laboratorium server dengan perangkat MikroTik dan fiber optic', 'icon' => 'dns'],
            ['nama' => 'Workshop Hardware', 'deskripsi' => 'Ruang praktik perakitan dan perbaikan hardware', 'icon' => 'build'],
        ];
        foreach ($tkjtFasilitas as $i => $item) {
            $tkjt->fasilitas()->create($item + ['urutan' => $i]);
        }

        // ======================== DKV ========================
        $dkv = \App\Models\ProgramKeahlian::create([
            'slug' => 'dkv',
            'singkatan' => 'DKV',
            'nama' => 'Desain Komunikasi Visual',
            'deskripsi_singkat' => 'Ekspresikan kreativitasmu melalui desain grafis profesional, fotografi artistik, dan produksi media digital yang berdampak.',
            'deskripsi' => '<p>Jurusan Desain Komunikasi Visual (DKV) adalah program keahlian yang mengembangkan kreativitas dan keterampilan visual siswa dalam berbagai media. Mulai dari desain grafis, ilustrasi digital, fotografi, videografi, hingga animasi.</p>
                <p>Siswa DKV dibekali dengan penguasaan software desain profesional, prinsip-prinsip desain, dan kemampuan bercerita visual yang kuat. Lulusan DKV siap berkarier sebagai desainer grafis, ilustrator, fotografer, atau content creator di industri kreatif.</p>',
            'icon' => 'palette',
            'icon_besar' => 'brush',
            'warna' => 'secondary',
            'warna_bg' => 'secondary-container/20',
            'warna_icon' => 'secondary-container/40',
            'warna_container' => 'secondary',
            'warna_container_bg' => 'secondary/10',
        ]);

        // DKV - Kompetensi
        $dkvKompetensi = ['Graphic Design', 'Photography', 'Video Editing', 'Digital Illustration', 'Animasi 2D & 3D', 'Branding & Marketing'];
        foreach ($dkvKompetensi as $i => $item) {
            $dkv->kompetensi()->create(['nama' => $item, 'urutan' => $i]);
        }

        // DKV - Mata Pelajaran
        $dkvMapel = ['Dasar Desain Grafis', 'Teknik Fotografi Digital', 'Videografi dan Animasi', 'Desain Media Interaktif', 'Ilustrasi Digital', 'Produk Kreatif dan Kewirausahaan'];
        foreach ($dkvMapel as $i => $item) {
            $dkv->mataPelajaran()->create(['nama' => $item, 'urutan' => $i]);
        }

        // DKV - Prestasi
        $dkvPrestasi = [
            ['tahun' => '2023', 'judul' => 'Juara 1 Lomba Desain Poster Tingkat Nasional', 'deskripsi' => 'Siswa DKV meraih juara pertama dalam lomba desain poster yang diadakan oleh Kementerian Pendidikan.', 'icon' => 'emoji_events'],
            ['tahun' => '2023', 'judul' => 'Juara 2 Fotografi Digital Tingkat Provinsi', 'deskripsi' => 'Karya fotografi siswa DKV berhasil meraih juara kedua dalam kompetisi fotografi digital se-Kaltim.', 'icon' => 'photo_camera'],
            ['tahun' => '2022', 'judul' => 'Best Creative Video Lomba Film Pendek', 'deskripsi' => 'Tim DKV meraih penghargaan video paling kreatif dalam lomba film pendek antar SMK.', 'icon' => 'videocam'],
        ];
        foreach ($dkvPrestasi as $i => $item) {
            $dkv->prestasi()->create($item + ['urutan' => $i]);
        }

        // DKV - Sertifikat
        $dkvSertifikat = [
            ['nama' => 'Adobe Certified Professional (ACP)', 'penyelenggara' => 'Adobe', 'deskripsi' => 'Sertifikasi internasional untuk penguasaan software Adobe seperti Photoshop, Illustrator, dan Premiere Pro.', 'icon' => 'brush'],
            ['nama' => 'BNSP Desainer Grafis Muda', 'penyelenggara' => 'BNSP', 'deskripsi' => 'Sertifikasi kompetensi nasional untuk desainer grafis tingkat pemula hingga madya.', 'icon' => 'verified'],
            ['nama' => 'Sertifikasi Fotografer Profesional', 'penyelenggara' => 'LSP Fotografi', 'deskripsi' => 'Sertifikasi kompetensi di bidang fotografi digital dan editing foto profesional.', 'icon' => 'camera'],
        ];
        foreach ($dkvSertifikat as $i => $item) {
            $dkv->sertifikat()->create($item + ['urutan' => $i]);
        }

        // DKV - Peluang Kerja
        $dkvKarir = ['Graphic Designer', 'UI/UX Designer', 'Fotografer Profesional', 'Video Editor', 'Content Creator', 'Brand Designer'];
        foreach ($dkvKarir as $i => $item) {
            $dkv->peluangKerja()->create(['nama' => $item, 'urutan' => $i]);
        }

        // DKV - Guru
        $dkvGuru = [
            ['nama' => 'Eka Putri, S.Ds.', 'bidang' => 'Desain Grafis'],
            ['nama' => 'Fajar Nugroho, S.Sn.', 'bidang' => 'Ilustrasi & Animasi'],
            ['nama' => 'Gita Permata, S.T.', 'bidang' => 'Fotografi & Videografi'],
            ['nama' => 'Hendra Gunawan, S.Kom.', 'bidang' => 'Desain Media Interaktif'],
        ];
        foreach ($dkvGuru as $i => $item) {
            $dkv->guru()->create($item + ['urutan' => $i]);
        }

        // DKV - Fasilitas
        $dkvFasilitas = [
            ['nama' => 'Lab Desain Grafis', 'deskripsi' => 'Laboratorium desain dengan 30 iMac dan software Adobe Creative Cloud', 'icon' => 'computer'],
            ['nama' => 'Studio Fotografi', 'deskripsi' => 'Studio profesional dengan peralatan lighting dan backdrop lengkap', 'icon' => 'camera'],
            ['nama' => 'Studio Produksi Video', 'deskripsi' => 'Ruang produksi video dengan green screen dan peralatan recording', 'icon' => 'videocam'],
        ];
        foreach ($dkvFasilitas as $i => $item) {
            $dkv->fasilitas()->create($item + ['urutan' => $i]);
        }

        // ======================== TAB (Teknik Alat Berat) ========================
        $tab = \App\Models\ProgramKeahlian::create([
            'slug' => 'tab',
            'singkatan' => 'TAB',
            'nama' => 'Teknik Alat Berat',
            'deskripsi_singkat' => 'Kuasai teknologi alat berat modern, sistem hidrolik, dan manajemen perawatan mesin industri pertambangan dan konstruksi.',
            'deskripsi' => '<p>Jurusan Teknik Alat Berat (TAB) adalah program keahlian yang berfokus pada penguasaan teknologi alat berat, sistem hidrolik, transmisi, dan perawatan mesin-mesin industri. Siswa dibekali keterampilan mulai dari pengoperasian, perawatan, hingga perbaikan alat berat seperti excavator, bulldozer, dan crane.</p>
                <p>Dengan kurikulum yang diselaraskan dengan kebutuhan industri pertambangan dan konstruksi, lulusan TAB siap bersaing di dunia kerja sebagai mekanik alat berat, operator, atau teknisi perawatan di perusahaan-perusahaan terkemuka.</p>',
            'icon' => 'construction',
            'icon_besar' => 'engineering',
            'warna' => 'tertiary',
            'warna_bg' => 'tertiary/20',
            'warna_icon' => 'tertiary/30',
            'warna_container' => 'tertiary',
            'warna_container_bg' => 'tertiary/10',
        ]);

        // TAB - Kompetensi
        $tabKompetensi = ['Sistem Hidrolik & Pneumatik', 'Mesin Diesel & Engine Tune-Up', 'Sistem Transmisi & Power Train', 'Perawatan & Perbaikan Alat Berat', 'Pengelasan & Fabrikasi Logam', 'Manajemen Bengkel Alat Berat'];
        foreach ($tabKompetensi as $i => $item) {
            $tab->kompetensi()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TAB - Mata Pelajaran
        $tabMapel = ['Gambar Teknik Mesin', 'Sistem Hidrolik dan Pneumatik', 'Motor Diesel dan Sistem Bahan Bakar', 'Perawatan dan Perbaikan Alat Berat', 'Pengelasan Dasar dan Fabrikasi', 'Produk Kreatif dan Kewirausahaan'];
        foreach ($tabMapel as $i => $item) {
            $tab->mataPelajaran()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TAB - Prestasi
        $tabPrestasi = [
            ['tahun' => '2023', 'judul' => 'Juara 1 Lomba Mekanik Alat Berat Tingkat Provinsi', 'deskripsi' => 'Tim TAB berhasil meraih juara pertama dalam kompetisi mekanik alat berat se-Kalimantan Timur.', 'icon' => 'emoji_events'],
            ['tahun' => '2022', 'judul' => 'Juara 2 Keterampilan Hidrolik Industri', 'deskripsi' => 'Siswa TAB meraih juara kedua dalam kompetisi sistem hidrolik antar SMK.', 'icon' => 'precision_manufacturing'],
        ];
        foreach ($tabPrestasi as $i => $item) {
            $tab->prestasi()->create($item + ['urutan' => $i]);
        }

        // TAB - Sertifikat
        $tabSertifikat = [
            ['nama' => 'BNSP Mekanik Alat Berat', 'penyelenggara' => 'BNSP', 'deskripsi' => 'Sertifikasi kompetensi nasional untuk mekanik alat berat tingkat terampil.', 'icon' => 'verified'],
            ['nama' => 'Sertifikasi Operator Alat Berat', 'penyelenggara' => 'Kementerian Ketenagakerjaan', 'deskripsi' => 'Sertifikasi pengoperasian alat berat yang diakui secara nasional.', 'icon' => 'badge'],
        ];
        foreach ($tabSertifikat as $i => $item) {
            $tab->sertifikat()->create($item + ['urutan' => $i]);
        }

        // TAB - Peluang Kerja
        $tabKarir = ['Mekanik Alat Berat', 'Operator Alat Berat', 'Teknisi Perawatan Mesin Industri', 'Supervisor Bengkel', 'Teknisi Hidrolik', 'Wirausaha Bengkel Alat Berat'];
        foreach ($tabKarir as $i => $item) {
            $tab->peluangKerja()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TAB - Guru
        $tabGuru = [
            ['nama' => 'Irfan Maulana, S.T.', 'bidang' => 'Sistem Hidrolik & Pneumatik'],
            ['nama' => 'Joko Susilo, A.Md.', 'bidang' => 'Mesin Diesel & Engine'],
            ['nama' => 'Kurniawan, S.T.', 'bidang' => 'Perawatan Alat Berat'],
        ];
        foreach ($tabGuru as $i => $item) {
            $tab->guru()->create($item + ['urutan' => $i]);
        }

        // TAB - Fasilitas
        $tabFasilitas = [
            ['nama' => 'Bengkel Alat Berat', 'deskripsi' => 'Bengkel praktik dengan peralatan standar industri alat berat', 'icon' => 'garage'],
            ['nama' => 'Lab Hidrolik', 'deskripsi' => 'Laboratorium sistem hidrolik dan pneumatik dengan simulator', 'icon' => 'precision_manufacturing'],
            ['nama' => 'Ruang Simulator', 'deskripsi' => 'Ruang simulator pengoperasian alat berat berbasis komputer', 'icon' => 'simulation'],
        ];
        foreach ($tabFasilitas as $i => $item) {
            $tab->fasilitas()->create($item + ['urutan' => $i]);
        }

        // ======================== TSM (Teknik Sepeda Motor) ========================
        $tsm = \App\Models\ProgramKeahlian::create([
            'slug' => 'tsm',
            'singkatan' => 'TSM',
            'nama' => 'Teknik Sepeda Motor',
            'deskripsi_singkat' => 'Pelajari teknologi sepeda motor terkini, sistem injeksi elektronik, dan teknik diagnostik mesin modern.',
            'deskripsi' => '<p>Jurusan Teknik Sepeda Motor (TSM) adalah program keahlian yang berfokus pada penguasaan teknologi sepeda motor modern. Siswa dibekali keterampilan mulai dari perawatan mesin, sistem kelistrikan, sistem injeksi (EFI), hingga diagnostik kerusakan menggunakan peralatan modern.</p>
                <p>Dengan perkembangan teknologi sepeda motor yang semakin canggih, lulusan TSM sangat dibutuhkan di bengkel resmi, bengkel umum, maupun sebagai wirausaha di bidang otomotif roda dua.</p>',
            'icon' => 'motorcycle',
            'icon_besar' => 'two_wheeler',
            'warna' => 'error',
            'warna_bg' => 'error/20',
            'warna_icon' => 'error/30',
            'warna_container' => 'error',
            'warna_container_bg' => 'error/10',
        ]);

        // TSM - Kompetensi
        $tsmKompetensi = ['Perawatan Mesin Sepeda Motor', 'Sistem Kelistrikan & EFI', 'Sistem Transmisi & Koping', 'Diagnostik Kerusakan', 'Sistem Pengereman & Suspensi', 'Manajemen Bengkel'];
        foreach ($tsmKompetensi as $i => $item) {
            $tsm->kompetensi()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TSM - Mata Pelajaran
        $tsmMapel = ['Teknik Dasar Otomotif', 'Perawatan Mesin Sepeda Motor', 'Sistem Kelistrikan dan Injeksi', 'Sistem Transmisi dan Casis', 'Diagnostik dan Alat Ukur', 'Produk Kreatif dan Kewirausahaan'];
        foreach ($tsmMapel as $i => $item) {
            $tsm->mataPelajaran()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TSM - Prestasi
        $tsmPrestasi = [
            ['tahun' => '2023', 'judul' => 'Juara 1 Lomba Teknik Sepeda Motor Tingkat Provinsi', 'deskripsi' => 'Tim TSM meraih juara pertama dalam kompetisi perawatan dan perbaikan sepeda motor.', 'icon' => 'emoji_events'],
            ['tahun' => '2022', 'judul' => 'Juara 3 Lomba Diagnostik EFI Nasional', 'deskripsi' => 'Siswa TSM meraih juara ketiga dalam kompetisi diagnostik sistem injeksi elektronik.', 'icon' => 'diagnosis'],
        ];
        foreach ($tsmPrestasi as $i => $item) {
            $tsm->prestasi()->create($item + ['urutan' => $i]);
        }

        // TSM - Sertifikat
        $tsmSertifikat = [
            ['nama' => 'BNSP Teknisi Sepeda Motor', 'penyelenggara' => 'BNSP', 'deskripsi' => 'Sertifikasi kompetensi nasional untuk teknisi sepeda motor tingkat terampil.', 'icon' => 'verified'],
            ['nama' => 'Sertifikasi Teknisi EFI', 'penyelenggara' => 'LSP Otomotif', 'deskripsi' => 'Sertifikasi khusus sistem injeksi elektronik untuk sepeda motor modern.', 'icon' => 'electrical_services'],
        ];
        foreach ($tsmSertifikat as $i => $item) {
            $tsm->sertifikat()->create($item + ['urutan' => $i]);
        }

        // TSM - Peluang Kerja
        $tsmKarir = ['Teknisi Sepeda Motor', 'Kepala Bengkel', 'Spesialis Diagnostik EFI', 'Wirausaha Bengkel Motor', 'Teknisi Service Center Resmi', 'Sales Spare Part'];
        foreach ($tsmKarir as $i => $item) {
            $tsm->peluangKerja()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TSM - Guru
        $tsmGuru = [
            ['nama' => 'Lukman Hakim, S.T.', 'bidang' => 'Mesin & Perawatan Motor'],
            ['nama' => 'M. Rizki, A.Md.', 'bidang' => 'Sistem Kelistrikan & EFI'],
            ['nama' => 'Nur Hidayat, S.T.', 'bidang' => 'Sistem Transmisi & Casis'],
        ];
        foreach ($tsmGuru as $i => $item) {
            $tsm->guru()->create($item + ['urutan' => $i]);
        }

        // TSM - Fasilitas
        $tsmFasilitas = [
            ['nama' => 'Bengkel TSM', 'deskripsi' => 'Bengkel praktik dengan 10 unit sepeda motor dan peralatan lengkap', 'icon' => 'garage'],
            ['nama' => 'Lab Diagnostik', 'deskripsi' => 'Laboratorium diagnostik dengan scanner EFI dan alat ukur digital', 'icon' => 'diagnosis'],
            ['nama' => 'Ruang Engine', 'deskripsi' => 'Ruang praktik engine dan transmisi dengan mesin potong', 'icon' => 'precision_manufacturing'],
        ];
        foreach ($tsmFasilitas as $i => $item) {
            $tsm->fasilitas()->create($item + ['urutan' => $i]);
        }

        // ======================== TKR (Teknik Kendaraan Ringan) ========================
        $tkr = \App\Models\ProgramKeahlian::create([
            'slug' => 'tkr',
            'singkatan' => 'TKR',
            'nama' => 'Teknik Kendaraan Ringan',
            'deskripsi_singkat' => 'Kuasai teknologi otomotif mobil modern, sistem manajemen mesin, dan teknik diagnostik kendaraan terkini.',
            'deskripsi' => '<p>Jurusan Teknik Kendaraan Ringan (TKR) adalah program keahlian yang berfokus pada penguasaan teknologi kendaraan ringan atau mobil. Siswa dibekali keterampilan mulai dari perawatan mesin bensin dan diesel, sistem kelistrikan mobil, sistem AC, hingga diagnostik kerusakan menggunakan peralatan scan modern.</p>
                <p>Dengan perkembangan industri otomotif yang pesat, lulusan TKR sangat dibutuhkan di bengkel resmi, dealer mobil, industri perakitan, maupun sebagai wirausaha bengkel mobil.</p>',
            'icon' => 'directions_car',
            'icon_besar' => 'time_to_leave',
            'warna' => 'primary',
            'warna_bg' => 'primary/20',
            'warna_icon' => 'primary/30',
            'warna_container' => 'primary',
            'warna_container_bg' => 'primary/10',
        ]);

        // TKR - Kompetensi
        $tkrKompetensi = ['Perawatan Mesin Bensin & Diesel', 'Sistem Kelistrikan Mobil', 'Sistem AC Mobil', 'Sistem Transmisi & Casis', 'Diagnostik Engine Scanner', 'Manajemen Bengkel Mobil'];
        foreach ($tkrKompetensi as $i => $item) {
            $tkr->kompetensi()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TKR - Mata Pelajaran
        $tkrMapel = ['Teknik Dasar Otomotif', 'Perawatan Mesin Kendaraan Ringan', 'Sistem Kelistrikan Kendaraan', 'Sistem AC dan Refrigerasi', 'Sistem Transmisi dan Casis', 'Produk Kreatif dan Kewirausahaan'];
        foreach ($tkrMapel as $i => $item) {
            $tkr->mataPelajaran()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TKR - Prestasi
        $tkrPrestasi = [
            ['tahun' => '2023', 'judul' => 'Juara 2 Lomba Teknik Kendaraan Ringan Tingkat Provinsi', 'deskripsi' => 'Tim TKR meraih juara kedua dalam kompetisi perawatan dan perbaikan mobil.', 'icon' => 'emoji_events'],
            ['tahun' => '2022', 'judul' => 'Juara 1 Lomba Diagnostik Mesin Diesel', 'deskripsi' => 'Siswa TKR meraih juara pertama dalam kompetisi diagnostik mesin diesel.', 'icon' => 'diagnosis'],
        ];
        foreach ($tkrPrestasi as $i => $item) {
            $tkr->prestasi()->create($item + ['urutan' => $i]);
        }

        // TKR - Sertifikat
        $tkrSertifikat = [
            ['nama' => 'BNSP Teknisi Kendaraan Ringan', 'penyelenggara' => 'BNSP', 'deskripsi' => 'Sertifikasi kompetensi nasional untuk teknisi kendaraan ringan tingkat terampil.', 'icon' => 'verified'],
            ['nama' => 'Sertifikasi Teknisi AC Mobil', 'penyelenggara' => 'LSP Otomotif', 'deskripsi' => 'Sertifikasi khusus perawatan dan perbaikan sistem AC kendaraan.', 'icon' => 'ac_unit'],
        ];
        foreach ($tkrSertifikat as $i => $item) {
            $tkr->sertifikat()->create($item + ['urutan' => $i]);
        }

        // TKR - Peluang Kerja
        $tkrKarir = ['Teknisi Mobil', 'Kepala Bengkel Mobil', 'Spesialis Diagnostik Mesin', 'Teknisi AC Mobil', 'Wirausaha Bengkel Mobil', 'Teknisi Dealer Resmi'];
        foreach ($tkrKarir as $i => $item) {
            $tkr->peluangKerja()->create(['nama' => $item, 'urutan' => $i]);
        }

        // TKR - Guru
        $tkrGuru = [
            ['nama' => 'Oscar Pratama, S.T.', 'bidang' => 'Mesin Bensin & Diesel'],
            ['nama' => 'Purnomo, A.Md.', 'bidang' => 'Sistem Kelistrikan Mobil'],
            ['nama' => 'Qori Amalia, S.T.', 'bidang' => 'Sistem AC & Refrigerasi'],
        ];
        foreach ($tkrGuru as $i => $item) {
            $tkr->guru()->create($item + ['urutan' => $i]);
        }

        // TKR - Fasilitas
        $tkrFasilitas = [
            ['nama' => 'Bengkel TKR', 'deskripsi' => 'Bengkel praktik dengan 5 unit mobil dan peralatan standar dealer', 'icon' => 'garage'],
            ['nama' => 'Lab Engine Scanner', 'deskripsi' => 'Laboratorium diagnostik dengan scanner mobil dan alat ukur digital', 'icon' => 'diagnosis'],
            ['nama' => 'Lab AC Mobil', 'deskripsi' => 'Laboratorium perawatan dan perbaikan sistem AC kendaraan', 'icon' => 'ac_unit'],
        ];
        foreach ($tkrFasilitas as $i => $item) {
            $tkr->fasilitas()->create($item + ['urutan' => $i]);
        }

        // ======================== LKS (Layanan Kesehatan) ========================
        $lks = \App\Models\ProgramKeahlian::create([
            'slug' => 'lks',
            'singkatan' => 'LKS',
            'nama' => 'Layanan Kesehatan',
            'deskripsi_singkat' => 'Kembangkan kompetensi di bidang layanan kesehatan, asuhan keperawatan dasar, dan farmasi klinik untuk masa depan cerah.',
            'deskripsi' => '<p>Jurusan Layanan Kesehatan (LKS) adalah program keahlian yang mempersiapkan siswa untuk bekerja di bidang kesehatan dan pelayanan medis. Siswa dibekali pengetahuan dan keterampilan dasar keperawatan, farmasi, gizi, serta administrasi kesehatan.</p>
                <p>Dengan kurikulum yang diselaraskan dengan standar tenaga kesehatan, lulusan LKS siap melanjutkan ke pendidikan tinggi kesehatan atau bekerja di puskesmas, klinik, rumah sakit, dan laboratorium kesehatan.</p>',
            'icon' => 'local_hospital',
            'icon_besar' => 'medical_services',
            'warna' => 'secondary',
            'warna_bg' => 'secondary-container/20',
            'warna_icon' => 'secondary-container/40',
            'warna_container' => 'secondary',
            'warna_container_bg' => 'secondary/10',
        ]);

        // LKS - Kompetensi
        $lksKompetensi = ['Asuhan Keperawatan Dasar', 'Farmasi Dasar', 'Gizi dan Kesehatan', 'Administrasi Kesehatan', 'Pertolongan Pertama (PPGD)', 'Kesehatan Masyarakat'];
        foreach ($lksKompetensi as $i => $item) {
            $lks->kompetensi()->create(['nama' => $item, 'urutan' => $i]);
        }

        // LKS - Mata Pelajaran
        $lksMapel = ['Dasar-dasar Keperawatan', 'Farmasi Dasar', 'Ilmu Gizi', 'Administrasi Kesehatan', 'Pertolongan Pertama Gawat Darurat', 'Produk Kreatif dan Kewirausahaan'];
        foreach ($lksMapel as $i => $item) {
            $lks->mataPelajaran()->create(['nama' => $item, 'urutan' => $i]);
        }

        // LKS - Prestasi
        $lksPrestasi = [
            ['tahun' => '2023', 'judul' => 'Juara 1 Lomba Pertolongan Pertama Tingkat Provinsi', 'deskripsi' => 'Tim LKS meraih juara pertama dalam kompetisi PPGD se-Kalimantan Timur.', 'icon' => 'emoji_events'],
            ['tahun' => '2022', 'judul' => 'Juara 2 Lomba Asuhan Keperawatan', 'deskripsi' => 'Siswa LKS meraih juara kedua dalam kompetisi asuhan keperawatan dasar.', 'icon' => 'healing'],
        ];
        foreach ($lksPrestasi as $i => $item) {
            $lks->prestasi()->create($item + ['urutan' => $i]);
        }

        // LKS - Sertifikat
        $lksSertifikat = [
            ['nama' => 'Sertifikat PPGD', 'penyelenggara' => 'PMI', 'deskripsi' => 'Sertifikasi pertolongan pertama gawat darurat yang diakui secara nasional.', 'icon' => 'verified'],
            ['nama' => 'Sertifikat Asisten Perawat', 'penyelenggara' => 'LSP Kesehatan', 'deskripsi' => 'Sertifikasi kompetensi sebagai asisten perawat tingkat dasar.', 'icon' => 'badge'],
        ];
        foreach ($lksSertifikat as $i => $item) {
            $lks->sertifikat()->create($item + ['urutan' => $i]);
        }

        // LKS - Peluang Kerja
        $lksKarir = ['Asisten Perawat', 'Administrasi Kesehatan', 'Pramu Saji Gizi', 'Asisten Farmasi', 'Kader Kesehatan Masyarakat', 'Wirausaha Produk Kesehatan'];
        foreach ($lksKarir as $i => $item) {
            $lks->peluangKerja()->create(['nama' => $item, 'urutan' => $i]);
        }

        // LKS - Guru
        $lksGuru = [
            ['nama' => 'Rina Safitri, S.Kep., Ns.', 'bidang' => 'Asuhan Keperawatan'],
            ['nama' => 'Siti Nurhaliza, S.Farm., Apt.', 'bidang' => 'Farmasi Dasar'],
            ['nama' => 'Tuti Alawiyah, S.Gz.', 'bidang' => 'Ilmu Gizi & Kesehatan'],
        ];
        foreach ($lksGuru as $i => $item) {
            $lks->guru()->create($item + ['urutan' => $i]);
        }

        // LKS - Fasilitas
        $lksFasilitas = [
            ['nama' => 'Lab Keperawatan', 'deskripsi' => 'Laboratorium keperawatan dengan phantom dan alat medis lengkap', 'icon' => 'biotech'],
            ['nama' => 'Lab Farmasi', 'deskripsi' => 'Laboratorium farmasi dengan peralatan peracikan obat', 'icon' => 'medication'],
            ['nama' => 'Lab Gizi', 'deskripsi' => 'Laboratorium gizi dengan peralatan analisis makanan', 'icon' => 'restaurant'],
        ];
        foreach ($lksFasilitas as $i => $item) {
            $lks->fasilitas()->create($item + ['urutan' => $i]);
        }
    }
}
