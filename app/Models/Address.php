<?php
namespace App\Models;

class Address {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO addresses (user_id, street, city, postal_code) VALUES (?, ?, ?, ?)");
return $stmt->execute([
$data['user_id'],
$data['street'],
$data['city'],
$data['postal_code'] ?? null
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE addresses SET street = ?, city = ?, postal_code = ? WHERE id = ?");
return $stmt->execute([
$data['street'],
$data['city'],
$data['postal_code'] ?? null,
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM addresses WHERE id = ?");
return $stmt->execute([$id]);
}
}