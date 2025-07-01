<?php

namespace App\Middleware;

class AuthMiddleware
{
  public static function handle()
  {
    // 1. Periksa apakah user sudah login
    if (!isset($_SESSION['user'])) {
      header('Location: ?page=login');
      exit;
    }

    // 2. Ambil peran dan halaman yang diakses
    $role = $_SESSION['user']['role'];
    $page = $_GET['page'] ?? 'supplier'; // Ambil halaman yang sedang diakses

    // 3. Jika peran adalah 'kasir', periksa halamannya
    if ($role === 'kasir') {
      // Daftar halaman yang boleh diakses oleh kasir
      $allowedPagesForKasir = ['transaction', 'report'];

      // Jika halaman yang diakses TIDAK ADA di dalam daftar yang diizinkan
      if (!in_array($page, $allowedPagesForKasir)) {
        // Tampilkan pesan error dan hentikan eksekusi
        http_response_code(403); // Kode "Forbidden"
        die("Akses Ditolak. Anda tidak memiliki izin untuk membuka halaman ini.");
      }
    }

    // Jika peran adalah 'admin', tidak ada batasan, jadi tidak perlu ada kode tambahan.
  }
}
