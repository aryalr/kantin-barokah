<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  public function create($username, $password, $role = 'kasir')
  {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $this->db->prepare(
      "INSERT INTO users (username, password, role) VALUES (?, ?, ?)"
    );
    return $stmt->execute([$username, $hashedPassword, $role]);
  }

  public function findByUsername($username)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getAll()
  {
    $stmt = $this->db->query("SELECT id_user, username, role FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteById($id)
  {
    $stmt = $this->db->prepare("DELETE FROM users WHERE id_user = ?");
    return $stmt->execute([$id]);
  }
}
