<?php
namespace App\Controllers;

use App\Models\User;

class ProfileController {
private $db;
private $userModel;

public function __construct($db) {
$this->db = $db;
$this->userModel = new User($db);
}

public function index() {
if (!isset($_SESSION['user_id'])) {
header('Location: /auth/login');
exit;
}

$user = $this->userModel->getById($_SESSION['user_id']);
require __DIR__ . '/../../resources/views/profile/index.php';
}

public function edit() {
if (!isset($_SESSION['user_id'])) {
header('Location: /auth/login');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = [
'name' => $_POST['name'],
'email' => $_POST['email']
];
if (!empty($_POST['password'])) {
$data['password'] = $_POST['password'];
}
$this->userModel->update($_SESSION['user_id'], $data);
header('Location: /profile');
} else {
$user = $this->userModel->getById($_SESSION['user_id']);
require __DIR__ . '/../../resources/views/profile/edit.php';
}
}
}