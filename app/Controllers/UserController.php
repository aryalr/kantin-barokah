<?php

namespace App\Controllers;

use App\Models\User;
use Smarty;

class UserController
{
  private $smarty;
  private $userModel;

  public function __construct(Smarty $smarty, User $userModel)
  {
    $this->smarty = $smarty;
    $this->userModel = $userModel;

    if (isset($_SESSION['user'])) {
      $this->smarty->assign('currentUser', $_SESSION['user']);
    }
  }

  public function index()
  {
    $allUsers = $this->userModel->getAll();
    $this->smarty->assign('users', $allUsers);
    $this->smarty->display('user/index.tpl');
  }

  public function create()
  {
    $this->smarty->display('user/create.tpl');
  }

  public function store()
  {
    // Sanitasi dan validasi input
    $username = htmlspecialchars(trim($_POST['username'] ?? ''), ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'] ?? '';

    // Pastikan username dan password tidak kosong
    if (empty($username) || empty($password)) {
      // (Opsional) Tambahkan pesan error ke session untuk ditampilkan di halaman create
      $this->redirect('users&action=create');
      return;
    }

    $this->userModel->create($username, $password, 'kasir');
    $this->redirect('users');
  }

  public function delete()
  {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $currentUserId = $_SESSION['user']['id_user'] ?? 0;

    if ($id && $id !== $currentUserId) {
      $this->userModel->deleteById($id);
    }

    $this->redirect('users');
  }

  private function redirect(string $page)
  {
    header("Location: /pos-app/public/index.php?page={$page}");
    exit;
  }
}
