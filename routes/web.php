<?php

use App\Controllers\LaporanController;
use App\Controllers\SupplierController;
use App\Controllers\ProductController;
use App\Controllers\TransactionController;
use App\Controllers\AuthController;
use App\Controllers\UserController; // <-- Pastikan ini ada

return [
    'login'       => AuthController::class,
    'logout'      => AuthController::class,
    'users'       => UserController::class, // <-- Baris ini ditambahkan
    'supplier'    => SupplierController::class,
    'product'     => ProductController::class,
    'transaction' => TransactionController::class,
    'report'      => LaporanController::class,
];
