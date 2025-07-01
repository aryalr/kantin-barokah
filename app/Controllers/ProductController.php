<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Smarty;
use App\Middleware\AuthMiddleware;

class ProductController
{
    private $smarty;

    public function __construct(Smarty $smarty)
    {
        AuthMiddleware::handle();
        $this->smarty = $smarty;
    }

    public function index()
    {
        $products = Product::getAll();
        $this->smarty->assign('products', $products);
        $this->smarty->display('product/index.tpl');
    }

    public function create()
    {
        $suppliers = Supplier::getAll();
        $this->smarty->assign('suppliers', $suppliers);
        $this->smarty->display('product/create.tpl');
    }

    public function store()
    {
        // Sanitasi dan validasi input
        $name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
        $purchasePrice = filter_input(INPUT_POST, 'purchase_price', FILTER_VALIDATE_FLOAT);
        $sellingPrice = filter_input(INPUT_POST, 'selling_price', FILTER_VALIDATE_FLOAT);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
        $supplierId = filter_input(INPUT_POST, 'id_supplier', FILTER_VALIDATE_INT);

        // (Opsional) Tambahkan validasi lebih lanjut, misalnya memastikan harga tidak negatif
        if ($purchasePrice === false || $sellingPrice === false || $stock === false || $supplierId === false) {
            // Handle error - mungkin redirect kembali dengan pesan error
            // Untuk saat ini, kita hentikan saja
            die("Input tidak valid.");
        }


        Product::insert($name, $purchasePrice, $sellingPrice, $stock, $supplierId);
        header('Location: index.php?page=product');
        exit; // Tambahkan exit setelah header redirect
    }

    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id) {
            $product = Product::getById($id);
            $suppliers = Supplier::getAll();
            $this->smarty->assign('product', $product);
            $this->smarty->assign('suppliers', $suppliers);
            $this->smarty->display('product/edit.tpl');
        } else {
            // Handle ID tidak valid
            die("ID produk tidak valid.");
        }
    }

    public function update()
    {
        // Sanitasi dan validasi input
        $id = filter_input(INPUT_POST, 'id_product', FILTER_VALIDATE_INT);
        $name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
        $purchasePrice = filter_input(INPUT_POST, 'purchase_price', FILTER_VALIDATE_FLOAT);
        $sellingPrice = filter_input(INPUT_POST, 'selling_price', FILTER_VALIDATE_FLOAT);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
        $supplierId = filter_input(INPUT_POST, 'id_supplier', FILTER_VALIDATE_INT);

        // (Opsional) Tambahkan validasi lebih lanjut
        if ($id === false || $purchasePrice === false || $sellingPrice === false || $stock === false || $supplierId === false) {
            // Handle error
            die("Input tidak valid.");
        }

        Product::update($id, $name, $purchasePrice, $sellingPrice, $stock, $supplierId);
        header('Location: index.php?page=product');
        exit; // Tambahkan exit setelah header redirect
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            die("ID produk tidak valid.");
        }

        Product::delete($id);
        header('Location: index.php?page=product');
        exit; // Tambahkan exit setelah header redirect
    }
}
