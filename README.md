# Kantin Barokah - Aplikasi Point of Sale (POS)

Aplikasi web Point of Sale (POS) sederhana yang dibangun dengan PHP native, dirancang untuk mengelola operasional "Kantin Barokah". Aplikasi ini memfasilitasi manajemen produk, supplier, transaksi penjualan, dan pengguna dengan dua peran berbeda: **Admin** dan **Kasir**.

## ✨ Fitur Utama

- **Manajemen Produk:** Kelola data produk (tambah, lihat, edit, hapus).
- **Manajemen Supplier:** Kelola data supplier (tambah, lihat, edit, hapus).
- **Manajemen Pengguna:** Admin dapat menambah dan menghapus pengguna (kasir).
- **Transaksi Penjualan:**
    - Membuat transaksi penjualan baru.
    - Melihat riwayat dan detail transaksi.
- **Laporan Penjualan:**
    - Menghasilkan laporan penjualan periodik.
    - Opsi untuk mencetak laporan.
- **Sistem Otentikasi:** Proses login dan logout yang aman untuk pengguna.
- **Kontrol Hak Akses (Otorisasi):**
    - **Admin:** Akses penuh ke semua fitur, termasuk manajemen produk, supplier, dan pengguna.
    - **Kasir:** Akses terbatas pada modul transaksi dan laporan penjualan.

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 8.x (Native)
- **Database:** MySQL / MariaDB
- **Frontend:** Smarty Template Engine, HTML, CSS
- **Manajemen Dependensi:** Composer
- **Konfigurasi:** `vlucas/phpdotenv` untuk pengelolaan *environment variables*.

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal Anda.

### 1. Prasyarat

- Web Server (XAMPP, Laragon, Apache, Nginx)
- PHP 8.0 atau versi lebih tinggi
- MySQL atau MariaDB
- Composer

### 2. Clone Repository

```bash
git clone https://github.com/username/kantin-barokah.git
cd kantin-barokah
```
*(Ganti `https://github.com/username/kantin-barokah.git` dengan URL repository Anda)*

### 3. Instal Dependensi

Jalankan Composer untuk menginstal semua dependensi PHP yang diperlukan.

```bash
composer install
```

### 4. Konfigurasi Database

1.  Buat database baru di MySQL/MariaDB Anda (misalnya, `kantin_barokah`).
2.  Impor struktur tabel dan data awal dari file `sql/pos_app_laragon.sql` ke dalam database yang baru Anda buat.

### 5. Konfigurasi Lingkungan (.env)

1.  Salin file `.env.example` menjadi `.env`.

    ```bash
    cp .env.example .env
    ```

2.  Buka file `.env` dan sesuaikan konfigurasi database dengan pengaturan lokal Anda.

    ```dotenv
    DB_HOST=localhost
    DB_DATABASE=kantin_barokah
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### 6. Buat Akun Admin

Aplikasi ini menyediakan skrip sederhana untuk membuat akun admin pertama kali.

- **Melalui Browser:** Buka `http://localhost/kantin-barokah/public/buat_admin.php`
- **Melalui CLI:** `php public/buat_admin.php`

Skrip ini akan membuat pengguna dengan kredensial default:
- **Username:** `admin`
- **Password:** `password`

**PENTING:** Sangat disarankan untuk mengubah password default di dalam skrip `buat_admin.php` sebelum menjalankannya, dan hapus file tersebut setelah akun admin berhasil dibuat untuk alasan keamanan.

### 7. Jalankan Aplikasi

Atur *document root* pada web server Anda ke direktori `public/`. Buka aplikasi di browser Anda (misalnya, `http://localhost/kantin-barokah/public/`).

## 📂 Struktur Proyek

```
/kantin-barokah
├── app/                    # Logika inti aplikasi (MVC)
│   ├── Config/             # Konfigurasi (Database)
│   ├── Controllers/        # Controller untuk menangani request
│   ├── Middleware/         # Middleware (Otentikasi, Otorisasi)
│   └── Models/             # Model untuk interaksi database
├── public/                 # Document root, file yang diakses publik
│   └── index.php           # Titik masuk utama (Front Controller)
├── resources/              # Aset frontend
│   └── views/              # File template Smarty (.tpl)
├── routes/                 # Definisi rute aplikasi
│   └── web.php             # Rute utama
├── sql/                    # File dump database
├── storage/                # Direktori untuk file cache, log, dll.
├── vendor/                 # Dependensi dari Composer
├── .env                    # File konfigurasi lingkungan (tidak di-commit)
├── .env.example            # Contoh file .env
├── composer.json           # Konfigurasi Composer
└── README.md               # File ini
```

## 🤝 Kontribusi

Kontribusi dalam bentuk *pull request*, laporan *bug*, atau saran fitur sangat diterima.

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).