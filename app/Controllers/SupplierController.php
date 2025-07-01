<?php

namespace App\Controllers;

use App\Models\Supplier;
use Smarty;
use App\Middleware\AuthMiddleware;

class SupplierController
{
    protected $smarty;

    public function __construct(Smarty $smarty)
    {
        AuthMiddleware::handle();
        $this->smarty = $smarty;
    }

    public function index()
    {
        $suppliers = Supplier::getAll();
        $this->smarty->assign('suppliers', $suppliers);
        $this->smarty->display('supplier/index.tpl');
    }

    public function create()
    {
        $this->smarty->display('supplier/create.tpl');
    }

    public function store()
    {
        $name = htmlspecialchars($_POST['supplier_name'] ?? '', ENT_QUOTES, 'UTF-8');
        $contact = htmlspecialchars($_POST['contact_info'] ?? '', ENT_QUOTES, 'UTF-8');

        if (!empty($name)) {
            Supplier::create($name, $contact);
            header("Location: index.php?page=supplier");
            exit;
        } else {
            die("Nama supplier tidak boleh kosong.");
        }
    }

    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $supplier = Supplier::getById($id);
            if ($supplier) {
                $this->smarty->assign('supplier', $supplier);
                $this->smarty->display('supplier/edit.tpl');
                return;
            }
        }
        die("Data tidak ditemukan atau ID tidak valid.");
    }

    public function update()
    {
        $id = filter_input(INPUT_POST, 'id_supplier', FILTER_VALIDATE_INT);
        $name = htmlspecialchars($_POST['supplier_name'] ?? '', ENT_QUOTES, 'UTF-8');
        $contact = htmlspecialchars($_POST['contact_info'] ?? '', ENT_QUOTES, 'UTF-8');

        if ($id && !empty($name)) {
            Supplier::update($id, $name, $contact);
            header("Location: index.php?page=supplier");
            exit;
        } else {
            die("Gagal memperbarui data. Input tidak valid.");
        }
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            Supplier::delete($id);
            header("Location: index.php?page=supplier");
            exit;
        } else {
            die("ID tidak ditemukan atau tidak valid untuk penghapusan.");
        }
    }
}
