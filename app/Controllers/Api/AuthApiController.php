<?php
namespace App\Controllers\Api;

use App\Models\User;
use Firebase\JWT\JWT;

class AuthApiController {
private $db;
private $userModel;

public function __construct($db) {
$this->db = $db;
$this->userModel = new User($db);
}

public function login($email, $password) {
$user = $this->userModel->getByEmail($email);
if ($user && password_verify($password, $user['password'])) {
$payload = [
'user_id' => $user['id'],
'email' => $user['email'],
'exp' => time() + 3600
];
$jwt = JWT::encode($payload, getenv('APP_KEY'), 'HS256');
header('Content-Type: application/json');
echo json_encode(['token' => $jwt]);
} else {
header('Content-Type: application/json');
echo json_encode(['error' => 'Invalid credentials']);
}
}
}