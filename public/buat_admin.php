<?php
// Script ini hanya untuk dijalankan sekali untuk membuat admin
require_once __DIR__ . '/../vendor/autoload.php';

// Ganti 'password_rahasia' dengan password yang Anda inginkan
$password_admin = 'password_rahasia';
$userModel = new \App\Models\User();
$userModel->create('admin', $password_admin, 'admin');

echo "Akun admin berhasil dibuat dengan username 'admin' dan password yang Anda tentukan.";
