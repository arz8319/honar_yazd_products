<?php
namespace App\Models;

class Wallet {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO wallets (user_id, balance) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['balance'] ?? 0
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM wallets WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetch();
}

public function updateBalance($userId, $amount) {
$stmt = $this->db->prepare("UPDATE wallets SET balance = balance + ? WHERE user_id = ?");
return $stmt->execute([$amount, $userId]);
}
}