# Diulem / Ngulem

Aplikasi undangan digital berbasis CodeIgniter 4 untuk membuat, mengelola, dan membagikan undangan pernikahan online. Project ini mencakup halaman utama, proses order, dashboard pengguna, panel admin, halaman undangan publik, buku tamu digital, tema undangan, pembayaran, dan pengiriman undangan lewat WhatsApp gateway.

## Ringkasan Fitur

- Landing page dan katalog tema undangan.
- Wizard order undangan multi-step.
- Dashboard pengguna untuk mengubah data undangan.
- Panel admin untuk mengelola pengguna, pembayaran, paket, tema, dan setting website.
- Halaman undangan publik berbasis subdomain.
- Buku tamu digital dengan QR/autofill dan pencatatan kehadiran.
- Import data tamu dari Excel.
- Integrasi pembayaran Midtrans dan Tripay.
- Integrasi WhatsApp gateway untuk pengiriman undangan dan notifikasi.
- Upload tema undangan dan tema video dari panel admin.

## Teknologi

- PHP >= 7.2
- CodeIgniter 4.0.1
- MySQL / MariaDB
- Composer
- Midtrans PHP SDK
- Xendit PHP SDK
- PHPExcel
- jQuery, Bootstrap, DataTables, Select2, dan asset frontend lokal

## Struktur Folder Penting

```text
app/
  Config/        Konfigurasi aplikasi, database, routes, filters, autoload
  Controllers/   Controller utama aplikasi
  Models/        Query Builder model untuk data bisnis
  Views/         Template halaman, dashboard, admin, undangan, dan buku tamu
  ThirdParty/    Library manual seperti PHPExcel
assets/
  admin/         Asset panel admin
  base/          Asset landing page dan order
  dashboard/     Asset dashboard pengguna
  themes/        Asset tema undangan
  themes_video/  Preview tema video
  users/         File upload pengguna
  bukti/         Bukti pembayaran manual
public/          Front controller alternatif dan asset publik
writable/        Cache, logs, session, dan upload runtime CodeIgniter
system/          Core CodeIgniter
vendor/          Dependency Composer
database.sql     Dump struktur dan seed database
```

## Domain Dan Subdomain

Routing project ini dipilih berdasarkan host/domain di `app/Config/Routes.php` dan konstanta di `app/Config/Constants.php`.

| Host | Area | Controller |
| --- | --- | --- |
| `diulem.com` | Domain utama, landing, order, dashboard user | `App\Controllers\base` |
| `www.diulem.com` | Domain utama dengan www | `App\Controllers\base` |
| `admin.diulem.com` | Panel admin | `App\Controllers\admin\Admin` |
| `kamu.diulem.com` | Halaman undangan publik | `App\Controllers\undangan\Undangan` |
| `bukutamu.diulem.com` | Buku tamu digital | `App\Controllers\bukutamu\Bukutamu` |

## Instalasi Lokal

1. Clone atau salin project ke web root lokal, misalnya:

   ```bash
   c:\laragon\www\ngulem
   ```

2. Install dependency Composer jika folder `vendor` belum tersedia:

   ```bash
   composer install
   ```

3. Buat database MySQL/MariaDB, lalu import:

   ```bash
   mysql -u root -p nama_database < database.sql
   ```

4. Sesuaikan koneksi database di `.env` atau `app/Config/Database.php`.

5. Pastikan folder runtime bisa ditulis:

   ```text
   writable/
   assets/users/
   assets/bukti/
   assets/themes/
   assets/themes_video/
   ```

6. Jalankan lewat virtual host Laragon atau web server lokal. Project ini sangat bergantung pada host/subdomain, jadi untuk pengujian penuh gunakan virtual host yang sesuai atau sesuaikan konstanta domain.

## Konfigurasi Penting

- `app/Config/Constants.php`: nama website, URL, domain, subdomain, dan base URL dinamis.
- `app/Config/Database.php`: koneksi database default.
- `.env`: environment dan override konfigurasi.
- `app/Config/Routes.php`: routing berbasis host.
- `app/Config/Filters.php`: filter auth user dan admin.
- `app/Config/Autoload.php`: autoload tambahan, termasuk PHPExcel.
- `.cpanel.yml`: deployment rsync ke cPanel.

## Alur Utama Aplikasi

1. Pengunjung memilih tema dari halaman utama.
2. Pengunjung membuat order melalui wizard `order`.
3. Sistem membuat data `users`, `order`, `mempelai`, `acara`, `data`, `rules`, `pembayaran`, dan asset user.
4. Pembayaran diproses manual, Midtrans, atau Tripay sesuai setting.
5. Setelah aktif, user login ke dashboard untuk mengatur undangan.
6. Undangan publik dibuka lewat subdomain `kamu.diulem.com/{domain}`.
7. Buku tamu dibuka lewat `bukutamu.diulem.com/{domain}` bila paket mengaktifkan fitur buku tamu.
8. Admin mengelola pembayaran, pengguna, paket, tema, testimoni, dan setting global.

## Keamanan Dan Catatan Maintenance

- Jangan commit kredensial production, token gateway, API key, atau password SMTP.
- Password user/admin di kode lama masih memakai `md5`; rencana perbaikan yang disarankan adalah migrasi ke `password_hash()` dan `password_verify()`.
- CSRF sudah tersedia di konfigurasi, tetapi pastikan filter `csrf` aktif sebelum membuka form publik/admin ke production.
- `setAutoRoute(true)` masih aktif; pertimbangkan menonaktifkannya setelah semua route eksplisit lengkap.
- File upload perlu validasi ketat, terutama upload tema `.php` dan `.zip`.
- Folder `writable/session`, `writable/logs`, `assets/users`, dan `assets/bukti` adalah data runtime, bukan source code.

## Deployment

Deployment cPanel dikonfigurasi di `.cpanel.yml`:

```yaml
deployment:
  tasks:
    - export DEPLOYPATH=/home/diulemco/public_html/
    - /bin/rsync -av --delete ./ $DEPLOYPATH
```

Pastikan file rahasia, log, session, cache, dan upload runtime tidak ikut terhapus/tertukar saat deploy. Jika server production menyimpan upload pengguna di folder yang sama, gunakan strategi exclude rsync atau pisahkan storage upload dari source code.

## Dokumentasi Tambahan

Lihat `arsitektur.md` untuk penjelasan arsitektur, routing, modul, database, dan catatan teknis yang lebih detail.
