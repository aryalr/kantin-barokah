# Aplikasi Point of Sale (POS) Sederhana

Sebuah aplikasi web Point of Sale (POS) yang dibangun dengan PHP native, dirancang untuk mengelola produk, supplier, transaksi penjualan, dan pengguna. Aplikasi ini memiliki dua peran pengguna: Admin dan Kasir, dengan hak akses yang berbeda.

## Fitur Utama

- **Manajemen Produk:** Tambah, lihat, edit, dan hapus data produk.
- **Manajemen Supplier:** Tambah, lihat, edit, dan hapus data supplier.
- **Manajemen Pengguna:** Admin dapat menambah dan menghapus pengguna (kasir).
- **Transaksi Penjualan:** Membuat transaksi baru dan melihat riwayat transaksi.
- **Laporan Penjualan:** Menghasilkan laporan penjualan dan mencetaknya.
- **Sistem Otentikasi:** Proses login dan logout yang aman.
- **Kontrol Hak Akses (Otorisasi):**
  - **Admin:** Memiliki akses penuh ke semua fitur.
  - **Kasir:** Hanya dapat mengakses modul transaksi dan laporan.

## Teknologi yang Digunakan

- **Backend:** PHP 8.x (Native)
- **Database:** MySQL / MariaDB
- **Frontend:** Smarty Template Engine, HTML, CSS
- **Manajemen Dependensi:** Composer
- **Pengelolaan Konfigurasi:** `phpdotenv` untuk environment variables

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di lingkungan lokal Anda.

### 1. Prasyarat

- Web Server (misalnya, Apache, Nginx)
- PHP 8.0 atau lebih tinggi
- MySQL atau MariaDB
- Composer

### 2. Clone Repository

```bash
git clone <URL_REPOSITORY_ANDA> pos-app
cd pos-app
```

### 3. Instal Dependensi

Jalankan Composer untuk menginstal semua dependensi yang diperlukan.

```bash
composer install
```

### 4. Konfigurasi Database

1.  Buat sebuah database baru di MySQL/MariaDB Anda dengan nama `pos_app`.
2.  Impor struktur tabel dan data awal dari salah satu file SQL yang disediakan:
    - `sql/pos_app.sql` (Struktur dan data)
    - `sql/pos_app_laragon.sql` (Disesuaikan untuk Laragon)

### 5. Konfigurasi Lingkungan (.env)

1.  Salin file `.env.example` menjadi `.env`.

    ```bash
    cp .env.example .env
    ```

2.  Buka file `.env` dan sesuaikan kredensial database jika berbeda dari pengaturan default.

    ```dotenv
    DB_HOST=localhost
    DB_DATABASE=pos_app
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### 6. Buat Akun Admin Awal

Aplikasi ini menyediakan skrip untuk membuat akun admin pertama kali. Jalankan skrip berikut melalui browser atau CLI.

- **Via Browser:** Buka `http://localhost/pos-app/public/buat_admin.php`
- **Via CLI:** `php public/buat_admin.php`

Skrip ini akan membuat pengguna dengan detail berikut:
- **Username:** `admin`
- **Password:** `password_rahasia` (Sangat disarankan untuk mengubah password ini di dalam skrip sebelum menjalankannya).

**PENTING:** Hapus atau amankan file `public/buat_admin.php` setelah akun admin berhasil dibuat untuk mencegah penyalahgunaan.

### 7. Jalankan Aplikasi

Atur *document root* web server Anda ke direktori `public/`. Buka aplikasi di browser Anda (misalnya, `http://localhost/pos-app/public/`).

## Cara Penggunaan

- **Login:** Gunakan kredensial akun yang telah Anda buat (admin atau kasir) untuk masuk ke sistem.
- **Navigasi:** Gunakan menu navigasi untuk mengakses berbagai modul sesuai dengan hak akses Anda.

## Struktur Folder Proyek

```
/pos-app
├── app/                    # Logika inti aplikasi
│   ├── Config/             # Konfigurasi (Database)
│   ├── Controllers/        # Controller untuk menangani request
│   ├── Middleware/         # Middleware (Otentikasi, Otorisasi)
│   └── Models/             # Model untuk interaksi database
├── public/                 # Document root, file yang diakses publik
│   └── index.php           # Titik masuk utama (front controller)
├── resources/              # Aset frontend
│   └── views/              # File template Smarty (.tpl)
├── routes/                 # Definisi rute aplikasi
│   └── web.php             # Rute utama
├── sql/                    # File dump database
├── storage/                # Folder untuk file cache, log, dll.
├── vendor/                 # Dependensi dari Composer
├── .env                    # File konfigurasi lingkungan (lokal)
├── .env.example            # Contoh file .env
├── composer.json           # Konfigurasi Composer
└── README.md               # Dokumentasi proyek
```
