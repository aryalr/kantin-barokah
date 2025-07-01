<?php
// untuk development
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

// Muat environment variables dari .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

session_start();

// Inisialisasi Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/../resources/views/');
$smarty->setCompileDir(__DIR__ . '/../storage/smarty/compile/');
$smarty->setCacheDir(__DIR__ . '/../storage/smarty/cache/');

// Registering number format untuk menghilangkan deprecated warning
$smarty->registerPlugin("modifier", "number_format", "number_format");

// Ambil routing
$routes = require __DIR__ . '/../routes/web.php';

// Atur halaman default dan ambil parameter dari URL
$defaultPage = 'supplier';
// Jika user belum login, paksa halaman menjadi 'login'
if (!isset($_SESSION['user'])) {
    $page = 'login';
} else {
    $page = $_GET['page'] ?? $defaultPage;
}
$action = $_GET['action'] ?? 'index';

// Halaman yang tidak perlu autentikasi
$noAuthNeeded = ['login', 'logout'];

// Jalankan middleware jika halaman butuh proteksi
if (!in_array($page, $noAuthNeeded)) {
    \App\Middleware\AuthMiddleware::handle();
}

// Cari controller berdasarkan route
if (array_key_exists($page, $routes)) {
    $controllerClass = $routes[$page];
    $controller = null;

    // Daftar controller yang membutuhkan User Model
    $controllersNeedingModel = [
        \App\Controllers\UserController::class,
        \App\Controllers\AuthController::class
    ];

    // Buat controller dengan dependensi yang benar
    if (in_array($controllerClass, $controllersNeedingModel)) {
        $controller = new $controllerClass($smarty, new \App\Models\User());
    } else {
        $controller = new $controllerClass($smarty);
    }

    // ==========================================================
    // === BLOK LOGIKA YANG DIPERBAIKI ADA DI BAWAH INI ===
    // ==========================================================

    // Panggil method yang sesuai dengan urutan logika yang benar
    if ($page === 'logout') {
        // 1. Langsung panggil method logout jika halaman adalah 'logout'
        $controller->logout();
    } else if ($page === 'login' && $action === 'index') {
        // 2. Jika ini halaman login default, panggil showLogin()
        $controller->showLogin();
    } else if (method_exists($controller, $action)) {
        // 3. Untuk semua kasus lain, panggil action yang diminta jika ada
        $controller->$action();
    } else {
        // 4. Tampilkan error jika tidak ada yang cocok
        echo "Action '$action' not found in controller '$page'";
    }
} else {
    // Tampilkan error jika halaman tidak ditemukan
    echo "Page '$page' not found.";
}
