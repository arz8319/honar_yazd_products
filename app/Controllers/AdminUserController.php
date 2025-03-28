<?php
namespace App\Controllers;

use App\Models\User;

class AdminUserController {
private $db;
private $userModel;

public function __construct($db) {
$this->db = $db;
$this->userModel = new User($db);
}

public function index() {
if (!isset($_SESSION['user_id']) || $this->userModel->getById($_SESSION['user_id'])['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

$users = $this->userModel->getAll();
require __DIR__ . '/../../resources/views/admin/users/index.php';
}

public function create() {
if (!isset($_SESSION['user_id']) || $this->userModel->getById($_SESSION['user_id'])['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = [
'name' => $_POST['name'],
'email' => $_POST['email'],
'password' => $_POST['password'],
'role_id' => $_POST['role_id']
];
$this->userModel->create($data);
header('Location: /admin/users');
} else {
require __DIR__ . '/../../resources/views/admin/users/create.php';
}
}
}