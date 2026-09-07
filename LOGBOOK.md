# Logbook Kegiatan PKL — Pengembangan Website SMKIM4

> Project: Website SMK Istiqomah Muhammadiyah 4 Samarinda (Laravel + Tailwind CSS)
> Catatan: Hari 1–15 telah diisi sebelumnya. Berikut lanjutan hari ke-16 sampai ke-50.

---

## Hari 16 — Membuat Header & Navigasi Responsif

Membuat navbar atas yang fixed berisi logo sekolah dan menu Home, Jurusan, Berita, Profil, Contact, SPMB. Menambahkan efek scroll (header berubah solid saat halaman digulir) dan bottom navigation khusus tampilan mobile. Mengatur padding konten agar tidak tertutup header.

- **File:** `resources/views/layouts/public.blade.php`, `resources/views/components/navigation/bottom-nav.blade.php`
- **Hasil:** Navigasi berfungsi di semua ukuran layar, menu aktif ditandai border bawah.

## Hari 17 — Membuat Halaman Beranda (Home)

Membangun halaman beranda sebagai landing page: hero section dengan gambar latar, sambutan kepala sekolah, dan penataan section. Menambahkan animasi fade-in menggunakan Intersection Observer agar tampilan lebih dinamis.

- **File:** `resources/views/home.blade.php`
- **Hasil:** Beranda tampil dengan hero, sambutan, dan animasi scroll.

## Hari 18 — Section Keunggulan & Fasilitas di Beranda

Membuat section keunggulan sekolah dan fasilitas berbentuk accordion di beranda. Data ditampilkan dinamis dari database melalui model `Unggulan` dan `FasilitasUmum`.

- **File:** `resources/views/home.blade.php`, `app/Models/Unggulan.php`, `app/Models/FasilitasUmum.php`
- **Hasil:** Keunggulan & fasilitas tampil dari database.

## Hari 19 — Section Berita Terbaru di Beranda

Menampilkan berita terbaru dalam layout bento grid di halaman beranda, lengkap dengan thumbnail, tanggal, dan link menuju halaman detail berita.

- **File:** `resources/views/home.blade.php`
- **Hasil:** Kartu berita terbaru tampil di beranda.

## Hari 20 — Halaman Berita & Detail Berita

Membuat halaman daftar berita dengan kartu, thumbnail, tanggal, kategori, dan pagination. Membuat halaman detail berita dengan isi lengkap dan slug URL yang ramah SEO.

- **File:** `resources/views/berita.blade.php`, `resources/views/berita-detail.blade.php`, `app/Http/Controllers/BeritaController.php`
- **Hasil:** Daftar berita + detail berita berfungsi dengan pagination.

## Hari 21 — Halaman Program Keahlian (Jurusan)

Membuat halaman daftar jurusan dengan kartu berisi logo dan nama jurusan, masing-masing dengan warna tema yang berbeda per jurusan.

- **File:** `resources/views/program-keahlian.blade.php`, `app/Http/Controllers/ProgramKeahlianController.php`
- **Hasil:** Kartu jurusan tampil dengan tema warna masing-masing.

## Hari 22 — Halaman Detail Jurusan

Membuat halaman detail jurusan berisi kompetensi keahlian, mata pelajaran, prestasi, sertifikat, guru, fasilitas, dan peluang kerja yang diambil dari database.

- **File:** `resources/views/program-keahlian-detail.blade.php`
- **Hasil:** Detail jurusan lengkap dengan semua sub-data.

## Hari 23 — Halaman Profil Sekolah

Membuat halaman profil berisi identitas sekolah, visi misi, dan sejarah. Data diambil dari tabel `profil_sekolah` agar mudah diubah admin.

- **File:** `resources/views/profile.blade.php`, `app/Models/ProfilSekolah.php`
- **Hasil:** Profil sekolah dinamis dari database.

## Hari 24 — Halaman Kontak

Membuat halaman kontak berisi alamat, nomor telepon, email, dan sosial media sekolah. Memastikan seluruh informasi kontak di footer tertaut dengan benar.

- **File:** `resources/views/contact.blade.php`
- **Hasil:** Halaman kontak lengkap dan tautan footer berfungsi.

## Hari 25 — Halaman SPMB (Pendaftaran Online)

Membuat halaman SPMB berisi informasi pendaftaran, alur, syarat, jadwal, dan kontak panitia dari tabel `pengaturan_spmb` dan `kontak_spmb`.

- **File:** `resources/views/spmb.blade.php`, `app/Models/PengaturanSpmb.php`, `app/Models/KontakSpmb.php`
- **Hasil:** Informasi SPMB tampil dinamis.

## Hari 26 — Halaman Tentang Pengembang & Penyempurnaan Footer

Membuat halaman tentang pengembang dan menyempurnakan footer: sosial media, quick links, info kontak, dan bagian copyright.

- **File:** `resources/views/tentang-pengembang.blade.php`, `resources/views/layouts/public.blade.php`
- **Hasil:** Footer lengkap dengan sosial media dan quick links.

## Hari 27 — Responsive Design & Uji Tampilan

Menguji seluruh halaman di berbagai ukuran layar (mobile, tablet, desktop), memperbaiki layout yang berantakan, dan memastikan navigasi mobile berfungsi.

- **Hasil:** Website tampil rapi di semua perangkat.

## Hari 28 — Sistem Login Admin

Membuat halaman login admin di `/admin` menggunakan autentikasi Laravel, melindungi route admin, dan menerapkan middleware role.

- **File:** `app/Http/Controllers/Auth/LoginController.php`, `resources/views/auth/login.blade.php`, `routes/web.php`
- **Hasil:** Login admin berfungsi dengan proteksi role.

## Hari 29 — Dashboard Admin

Membuat dashboard admin yang menampilkan ringkasan data (jumlah berita, jurusan, pengguna) dan tautan cepat ke menu pengelolaan.

- **File:** `resources/views/dashboard/`, `app/Http/Controllers/Dashboard/DashboardController.php`
- **Hasil:** Dashboard admin dengan ringkasan data.

## Hari 30 — CRUD Berita (Admin)

Membuat fitur tambah, ubah, hapus, dan lihat berita di panel admin, termasuk upload gambar dan editor isi berita.

- **File:** `app/Http/Controllers/Admin/BeritaController.php`, `resources/views/admin/berita/`
- **Hasil:** Pengelolaan berita lengkap (CRUD + upload gambar).

## Hari 31 — CRUD Program Keahlian (Admin)

Membuat fitur pengelolaan jurusan di admin: tambah, ubah, hapus, upload logo, gambar, dan hero background.

- **File:** `app/Http/Controllers/Admin/ProgramKeahlianController.php`, `resources/views/admin/program-keahlian/`
- **Hasil:** Pengelolaan jurusan lengkap.

## Hari 32 — Sub-Resources Jurusan (Admin)

Membuat pengelolaan kompetensi, mata pelajaran, prestasi, sertifikat, guru, fasilitas, dan peluang kerja untuk tiap jurusan di panel admin.

- **File:** `app/Http/Controllers/Admin/ProgramResourceController.php`
- **Hasil:** Semua sub-data jurusan bisa dikelola admin.

## Hari 33 — Pengaturan Home (Admin)

Membuat halaman pengaturan konten beranda (hero background, sambutan, dll.) yang bisa diubah admin tanpa mengubah kode.

- **File:** `app/Http/Controllers/Admin/PengaturanHomeController.php`, `resources/views/admin/pengaturan-home/`
- **Hasil:** Konten beranda bisa diubah dari panel admin.

## Hari 34 — Pengaturan SPMB & Kontak SPMB (Admin)

Membuat halaman pengaturan informasi SPMB dan kontak panitia yang dapat diubah langsung oleh admin.

- **File:** `app/Http/Controllers/Admin/PengaturanSpmbController.php`, `app/Http/Controllers/Admin/KontakSpmbController.php`
- **Hasil:** Info SPMB bisa diubah dari panel admin.

## Hari 35 — Pengaturan Sosial Media (Admin)

Membuat halaman pengaturan link sosial media (YouTube, Instagram, Facebook, TikTok) yang tampil di footer dan halaman kontak.

- **File:** `app/Http/Controllers/Admin/PengaturanSosialMediaController.php`, `resources/views/admin/sosial-media/`
- **Hasil:** Link sosial media bisa diubah dari panel admin.

## Hari 36 — Manajemen User & Role

Membuat CRUD user admin dan sistem role (admin & editor) agar akses setiap pengguna dibatasi sesuai perannya.

- **File:** `app/Http/Controllers/Admin/UserController.php`, `resources/views/admin/users/`
- **Hasil:** User & role terkelola dengan baik.

## Hari 37 — Validasi Form & Keamanan

Menambahkan validasi input di semua form admin, proteksi CSRF, dan penanganan error agar data yang masuk benar dan aman.

- **Hasil:** Semua form tervalidasi dan aman.

## Hari 38 — Pengaturan Profil Sekolah (Admin)

Membuat halaman admin untuk mengubah data profil sekolah: identitas, visi misi, dan sejarah.

- **File:** `app/Http/Controllers/Admin/ProfilSekolahController.php`, `resources/views/admin/profil-sekolah/`
- **Hasil:** Profil sekolah bisa diubah dari panel admin.

## Hari 39 — Upload & Manajemen File

Menyempurnakan sistem upload gambar di seluruh fitur: validasi tipe dan ukuran file, serta penanganan penghapusan file dari storage.

- **Hasil:** Upload file aman dan file lama terhapus otomatis.

## Hari 40 — SEO & Sitemap

Menambahkan meta tag SEO, favicon, dan halaman `sitemap.xml` agar website mudah ditemukan mesin pencari.

- **File:** `app/Http/Controllers/SitemapController.php`, `resources/views/sitemap.blade.php`
- **Hasil:** Sitemap & meta SEO terpasang.

## Hari 41 — Optimasi Kecepatan & Gambar

Mengoptimalkan ukuran gambar, meminimalkan permintaan aset, dan memastikan website cepat dimuat.

- **Hasil:** Waktu muat halaman lebih cepat.

## Hari 42 — Seeder & Data Awal Database

Membuat seeder untuk data awal: user admin, jurusan, berita contoh, dan pengaturan, sehingga project siap langsung digunakan.

- **File:** `database/seeders/`
- **Hasil:** Project bisa langsung dijalankan dengan data awal.

## Hari 43 — Uji Coba Fitur End-to-End

Melakukan uji coba menyeluruh semua fitur dari sisi pengunjung dan admin, serta mencatat bug yang ditemukan.

- **Hasil:** Daftar bug teridentifikasi.

## Hari 44 — Perbaikan Bug & Penyempurnaan

Memperbaiki bug hasil uji coba, menyempurnakan detail desain, dan memastikan konsistensi antar halaman.

- **Hasil:** Bug diperbaiki dan desain konsisten.

## Hari 45 — Persiapan Deployment

Menyiapkan konfigurasi hosting: environment production, kompilasi aset, migrasi database, dan izin folder storage.

- **Hasil:** Project siap dideploy.

## Hari 46 — Deployment Website

Men-deploy website ke server/hosting dan menguji semua halaman di lingkungan production.

- **Hasil:** Website live di hosting.

## Hari 47 — Backup & Keamanan

Membuat prosedur backup database dan file, mengatur izin akses, dan memastikan file `.env` tidak terekspos publik.

- **Hasil:** Prosedur backup & keamanan siap.

## Hari 48 — Dokumentasi Penggunaan Admin

Membuat dokumentasi penggunaan website untuk admin: cara login, mengelola berita, jurusan, dan pengaturan.

- **Hasil:** Dokumentasi admin tersedia.

## Hari 49 — Uji Penerimaan & Demo ke Sekolah

Melakukan demo website kepada pihak sekolah, menerima masukan, dan mencatat perbaikan yang diminta.

- **Hasil:** Masukan sekolah tercatat.

## Hari 50 — Finalisasi & Penyerahan Project

Menyelesaikan perbaikan terakhir, membuat laporan kegiatan PKL, dan menyerahkan project beserta dokumentasi.

- **Hasil:** Project diserahkan beserta laporan.

## Hari 51 — CRUD Program Keahlian: Fitur Tambah & Hapus (Admin)

Menambahkan fitur tambah dan hapus program keahlian di panel admin (sebelumnya hanya bisa edit). Admin bisa membuat program baru (singkatan, nama, deskripsi singkat, deskripsi lengkap TinyMCE) lalu langsung melengkapi gambar/logo/detail, serta menghapus program beserta seluruh data terkait.

- **File:** `app/Http/Controllers/Admin/ProgramKeahlianController.php`, `resources/views/admin/program-keahlian/index.blade.php`, `resources/views/admin/program-keahlian/create.blade.php` (baru)
- **Hasil:** Tombol Tambah & Hapus berfungsi; data uji "UJI" berhasil ditambah lalu dihapus kembali (diverifikasi di browser, DB kembali 6 program).

## Hari 52 — Form Tanpa Isian Ikon: Ikon Otomatis dari Server (Admin)

Menghilangkan semua input teks "Icon (Material Symbol)" yang membingungkan di form admin. Sekarang admin tidak perlu tahu nama ikon Google Fonts — sistem memilihkan ikon otomatis (pool ikon sesuai jenis konten, diputar bergantian agar tidak kembar). Ikon lama dipertahankan saat edit.

- **File:**
    - `app/Http/Controllers/Admin/BeritaController.php` — ikon berita mengikuti kategori (ikon jurusan dari program_keahlian, `campaign` utk General)
    - `app/Http/Controllers/Admin/FasilitasUmumController.php` & `UnggulanController.php` — pool 16 ikon, rotasi `count % 16`
    - `app/Http/Controllers/Admin/ProgramResourceController.php` — pool 10 utk prestasi, 14 utk fasilitas program
    - View: `berita/form`, `fasilitas-umum/form`, `unggulan/form`, `program-keahlian/resources/prestasi`, `fasilitas`, `profil-sekolah/index` (input jadi hidden)
- **Perbaikan tambahan:** bug JS `addTimeline/addNilai/addStruktur` di profil-sekolah yang memakai jumlah baris sbg index baru (bentrok saat data lama ber-key tak urut setelah penghapusan) → kini memakai `max index + 1`.
- **Hasil:** Diverifikasi di browser — form bersih tanpa field ikon; data uji tersimpan otomatis berikon (`book` utk fasilitas, `medal` utk prestasi) lalu dihapus; baris baru timeline/nilai/struktur membawa ikon default tersembunyi tanpa duplikasi index; halaman publik (`/profile` dll.) tetap menampilkan ikon normal.

---

> **Catatan:** Sesuaikan tanggal dan detail sesuai pelaksanaan sebenarnya. Kolom "File" opsional — bisa dihapus jika format logbook sekolah tidak membutuhkannya.
