<?php

namespace App\Controllers;

use App\Models\User;
use Smarty;

class AuthController
{
  private $smarty;
  private $userModel;

  public function __construct(Smarty $smarty, User $userModel)
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->smarty = $smarty;
    $this->userModel = $userModel;
  }

  public function showLogin()
  {
    $this->smarty->display('auth/login.tpl');
  }

  public function login()
  {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = $this->userModel->findByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
      unset($user['password']);
      $_SESSION['user'] = $user;
      header('Location: /pos-app/public');
      exit;
    } else {
      $this->smarty->assign('error', 'Username atau password salah');
      $this->smarty->display('auth/login.tpl');
    }
  }

  public function logout()
  {
    session_destroy();
    header('Location: /pos-app/public/index.php?page=login');
    exit;
  }
}
