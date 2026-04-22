# Arsitektur Project Diulem / Ngulem

Dokumen ini menjelaskan susunan teknis project, pembagian modul, alur request, struktur data, dan area yang perlu diperhatikan saat melakukan pengembangan.

## 1. Gambaran Umum

Project ini adalah aplikasi monolith berbasis CodeIgniter 4. Semua area aplikasi berada dalam satu codebase:

- Website utama dan landing page.
- Wizard pemesanan undangan.
- Dashboard pengguna.
- Panel admin.
- Renderer undangan publik.
- Buku tamu digital.
- Integrasi pembayaran dan WhatsApp gateway.

Aplikasi tidak memakai pemisahan API/backend/frontend modern. Sebagian besar halaman dirender server-side melalui view PHP CodeIgniter.

## 2. Entry Point

Ada dua front controller:

- `index.php` di root.
- `public/index.php`.

Keduanya memuat `app/Config/Paths.php`, lalu bootstrap CodeIgniter dari folder `system`.

Pada deployment saat ini, root project tampaknya diarahkan langsung ke document root cPanel. Karena itu file `index.php` root masih penting.

## 3. Konfigurasi Inti

| File | Fungsi |
| --- | --- |
| `app/Config/App.php` | Base URL, session, cookie, timezone, CSRF config, CSP |
| `app/Config/Constants.php` | Domain, URL aplikasi, nama website, konstanta global |
| `app/Config/Database.php` | Koneksi database default dan test |
| `app/Config/Routes.php` | Routing berbasis host/subdomain |
| `app/Config/Filters.php` | Alias filter dan proteksi route user/admin |
| `app/Config/Autoload.php` | Namespace dan classmap tambahan |
| `.env` | Override konfigurasi environment |
| `.cpanel.yml` | Script deployment cPanel |

## 4. Routing Berbasis Host

Routing utama memakai kondisi `$_SERVER['HTTP_HOST']`. Artinya host request menentukan namespace controller yang dipakai.

```text
diulem.com / www.diulem.com
  -> App\Controllers\base

admin.diulem.com
  -> App\Controllers\admin

kamu.diulem.com
  -> App\Controllers\undangan

bukutamu.diulem.com
  -> App\Controllers\bukutamu
```

Konstanta domain berada di `app/Config/Constants.php`:

```php
DOMAIN_UTAMA
DOMAIN_UTAMA_WWW
DOMAIN_UNDANGAN
DOMAIN_ADMIN
DOMAIN_BUKUTAMU
```

Route eksplisit sudah banyak didefinisikan, tetapi `setAutoRoute(true)` masih aktif. Ini membuat method controller bisa tetap diakses otomatis jika pola URL cocok.

## 5. Modul Controller

### 5.1 Base / Domain Utama

Folder: `app/Controllers/base`

| Controller | Tanggung Jawab |
| --- | --- |
| `Beranda` | Landing page, katalog tema, demo undangan, callback pembayaran, pengiriman undangan massal |
| `Order` | Wizard order undangan, upload foto awal, simpan data order, invoice awal |
| `Dashboard` | Login user, dashboard, edit undangan, fitur, tema, tamu, buku tamu, pembayaran |
| `Lupa_password` | Reset password lewat email dan WhatsApp |

### 5.2 Admin

Folder: `app/Controllers/admin`

| Controller | Tanggung Jawab |
| --- | --- |
| `Admin` | Login admin, dashboard, pembayaran, pengguna, setting, paket, tema, kategori, testimoni |

### 5.3 Undangan Publik

Folder: `app/Controllers/undangan`

| Controller | Tanggung Jawab |
| --- | --- |
| `Undangan` | Membuka undangan berdasarkan domain, mengambil data mempelai/acara/rules/theme, komentar, tracking pengunjung |

### 5.4 Buku Tamu

Folder: `app/Controllers/bukutamu`

| Controller | Tanggung Jawab |
| --- | --- |
| `Bukutamu` | Membuka halaman buku tamu, autofill berdasarkan QR, menyimpan kehadiran |

## 6. Model Dan Akses Database

Model memakai CodeIgniter Query Builder secara langsung. Sebagian besar model mendefinisikan builder tabel di constructor.

| Model | Area |
| --- | --- |
| `App\Models\base\BerandaModel` | Landing, demo, callback, data undangan publik dari domain utama |
| `App\Models\base\OrderModel` | Proses order dan penyimpanan data awal |
| `App\Models\base\DashboardModel` | Operasi dashboard user |
| `App\Models\admin\AdminModel` | Operasi admin |
| `App\Models\undangan\UndanganModel` | Halaman undangan publik |
| `App\Models\bukutamu\BukutamuModel` | Buku tamu dan kehadiran |
| `TemaModel`, `TemaCategoriesModel` | Pagination/filter tema undangan |
| `VideoModel`, `VideoCategoriesModel` | Pagination/filter tema video |

Model ini belum memakai pola penuh CodeIgniter Model seperti `$table`, `$primaryKey`, dan `$allowedFields` untuk semua operasi.

## 7. Database

Skema awal tersedia di `database.sql`.

### 7.1 Tabel Akun Dan Admin

| Tabel | Fungsi |
| --- | --- |
| `users` | Akun pengguna/customer |
| `admin` | Akun admin panel |

### 7.2 Tabel Order Dan Pembayaran

| Tabel | Fungsi |
| --- | --- |
| `order` | Domain undangan, theme, paket, status |
| `paket` | Paket undangan dan fitur yang aktif |
| `pembayaran` | Invoice, bukti bayar, VA/payment data, status pembayaran |
| `setting_pembayaran` | Konfigurasi manual, Midtrans, Tripay |

### 7.3 Tabel Konten Undangan

| Tabel | Fungsi |
| --- | --- |
| `mempelai` | Data mempelai pria/wanita dan orang tua |
| `acara` | Jadwal acara, lokasi, maps, countdown |
| `data` | Foto, maps global, video, kunci folder asset, salam, token WA |
| `rules` | Toggle section/fitur undangan |
| `album` | Daftar foto album user |
| `cerita` | Cerita pasangan |
| `rekening` | Rekening/kado digital |
| `quote` | Quote undangan |

### 7.4 Tabel Publik, Tamu, Dan Statistik

| Tabel | Fungsi |
| --- | --- |
| `tamu` | Daftar tamu, slug, nomor WA, QR code, status kirim/hadir |
| `komen` | Komentar/ucapan undangan |
| `pengunjung` | Tracking pengunjung undangan |
| `slider_bukutamu` | Slider foto di buku tamu |
| `testimoni` | Testimoni pengguna |

### 7.5 Tabel Tema

| Tabel | Fungsi |
| --- | --- |
| `themes` | Tema undangan website |
| `tema_categories` | Kategori tema website |
| `themes_video` | Tema undangan video |
| `video_categories` | Kategori tema video |

## 8. View Layer

View memakai PHP template biasa.

```text
app/Views/base/beranda/       Landing page, tema, error
app/Views/base/order/         Wizard order
app/Views/base/dashboard/     Dashboard pengguna
app/Views/admin/              Panel admin
app/Views/undangan/themes/    Template undangan publik
app/Views/bukutamu/           Buku tamu digital
```

Theme undangan adalah file PHP di `app/Views/undangan/themes/{kode_theme}.php`, sedangkan asset theme berada di `assets/themes/{kode_theme}`.

### 8.1 Design System Dashboard

Dashboard pengguna memakai Tabler sebagai design system utama. Pola yang dijadikan standar:

- `page-body`, `container-xl`, `page-header`, `row row-cards`.
- `card`, `card-header`, `card-title`.
- `table table-vcenter card-table`.
- `btn`, `badge`, `alert`, `modal`, `form-control`, `form-switch`.

Custom CSS dashboard dibatasi pada branding dan helper project:

- warna utama dan active state sidebar/topbar,
- radius/shadow yang konsisten,
- styling DataTables agar menyatu dengan card Tabler,
- helper upload, preview foto, empty state, dan tombol icon-only.

Helper dan partial penting:

- `assets/dashboard/js/diulem-dashboard.js` untuk AJAX, loading state, SweetAlert notification, confirm dialog, dan reload.
- `app/Views/base/dashboard/components/confirm_modal.php` untuk modal konfirmasi reusable.

Panel admin memakai pendekatan migrasi yang sama secara bertahap. Batch awal difokuskan pada layout admin, tabel pembayaran, tabel pengguna, modal konfirmasi, DataTables, dan feedback AJAX.

## 9. Asset Dan Upload

| Folder | Fungsi |
| --- | --- |
| `assets/admin` | CSS/JS/image panel admin |
| `assets/dashboard` | CSS/JS/image dashboard user |
| `assets/base` | CSS/JS/image landing dan order |
| `assets/themes` | Asset tema undangan |
| `assets/themes_video` | Preview tema video |
| `assets/users/{kunci}` | Foto user, album, musik, slider, QR rekening |
| `assets/bukti` | Bukti pembayaran manual |
| `assets/bukutamu` | Asset buku tamu |
| `writable/session` | Session file CodeIgniter |
| `writable/logs` | Log runtime |
| `writable/cache` | Cache runtime |

`kunci` umumnya dibuat dari kombinasi data user/domain, lalu dipakai sebagai nama folder asset user.

Asset lama yang masih dipakai sementara:

- Bootstrap lama untuk kompatibilitas modal/dropdown lama.
- Ruang Admin CSS/JS untuk halaman yang belum selesai dimigrasi penuh.
- FontAwesome dan LineIcons untuk ikon lama di beberapa halaman.
- Croppie untuk crop foto mempelai.
- Dropzone untuk upload gallery dan slider buku tamu.
- DataTables Bootstrap untuk tabel lama.

Penghapusan asset lama sebaiknya dilakukan setelah dashboard admin selesai dimigrasi agar dependency yang tersisa bisa diaudit akurat.

## 10. Auth Dan Session

### User

- Login route: `/login` pada domain utama.
- Session penanda: `masukUser`.
- Filter: `authuser`.
- Route yang dilindungi: `user/*`.

### Admin

- Login route: `/login` pada subdomain admin.
- Session penanda: `masukAdmin`.
- Filter: `authadmin`.
- Route yang dilindungi: `admin/*`.

Password saat ini dibandingkan memakai hash `md5`.

## 11. Integrasi Eksternal

### Pembayaran

- Midtrans digunakan untuk Snap token dan notification callback.
- Tripay digunakan untuk pembayaran alternatif.
- Xendit dependency tersedia, tetapi penggunaan aktif perlu dicek per flow terbaru.

Setting payment disimpan di tabel `setting_pembayaran`.

### WhatsApp Gateway

Kode mendukung beberapa gateway:

- `nusagateway`
- `starsender`
- `onesender`

Token global ada di tabel `setting`, sedangkan token per user bisa berada di tabel `data`.

### Email

SMTP diambil dari tabel `setting`:

- `host_email`
- `email`
- `pass_email`

Dipakai untuk notifikasi order, pembayaran, dan reset password.

## 12. Alur Order

1. User memilih tema dari halaman tema.
2. Controller `Order` menyimpan pilihan ke session.
3. User mengisi data akun, mempelai, acara, cerita, gallery.
4. Data sementara disimpan di session selama wizard.
5. Saat finish, sistem menyimpan data utama ke database.
6. Sistem membuat invoice pembayaran.
7. User diarahkan ke halaman sukses/order result.
8. Setelah pembayaran aktif, user bisa mengelola undangan dari dashboard.

## 13. Alur Undangan Publik

1. Request masuk ke `kamu.diulem.com/{domain}`.
2. `Routes.php` mengarahkan ke controller `Undangan`.
3. Sistem mencari data `order` berdasarkan domain.
4. Sistem mengambil data mempelai, acara, rules, album, cerita, rekening, komentar, pembayaran, dan theme.
5. Jika ada segment tamu, sistem mengambil data tamu dan QR.
6. Sistem render view `app/Views/undangan/themes/{kode_theme}.php`.
7. Pengunjung dapat mengirim komentar jika fitur aktif.

## 14. Alur Buku Tamu

1. Request masuk ke `bukutamu.diulem.com/{domain}`.
2. Sistem cek domain, paket, dan status pembayaran.
3. View buku tamu dirender dengan data mempelai/acara/slider.
4. QR/autofill mencari data tamu berdasarkan `qrcode`.
5. Kehadiran disimpan ke tabel `tamu` melalui status dan `waktu_hadir`.

## 15. Deployment

File `.cpanel.yml` melakukan:

```text
rsync -av --delete ./ /home/diulemco/public_html/
```

Karena memakai `--delete`, pastikan folder upload production tidak ikut hilang saat source lokal berbeda. Untuk production yang aman, pertimbangkan:

- Pisahkan storage upload dari source code.
- Tambahkan exclude rsync untuk `writable/session`, `writable/logs`, `assets/users`, dan `assets/bukti`.
- Gunakan environment server untuk kredensial, bukan file yang ikut deploy.

## 16. Risiko Teknis Yang Perlu Diprioritaskan

1. Kredensial production berada di file konfigurasi.
2. Password masih memakai `md5`.
3. CSRF global belum aktif di `Filters.php`.
4. Auto route masih aktif.
5. Upload tema mengizinkan file PHP dan ZIP, sehingga perlu validasi dan kontrol akses kuat.
6. Banyak operasi `unlink`, `mkdir`, dan upload memakai path relatif.
7. Library/framework cukup lama, sehingga ada warning/deprecated pada PHP modern.
8. Folder runtime dan upload tercampur di dalam source tree.

## 17. Rekomendasi Pengembangan Berikutnya

- Pindahkan secret ke `.env` server dan rotasi credential yang pernah masuk repo.
- Migrasi password ke `password_hash()` secara bertahap.
- Aktifkan CSRF untuk form yang tidak membutuhkan webhook/callback eksternal.
- Batasi auto route dan pastikan semua endpoint penting eksplisit.
- Buat service/helper terpusat untuk WhatsApp gateway, payment gateway, dan upload file.
- Pisahkan upload runtime dari folder source.
- Tambahkan test minimal untuk auth, order, callback pembayaran, dan update domain.
- Dokumentasikan format callback Midtrans/Tripay dan payload WhatsApp.
