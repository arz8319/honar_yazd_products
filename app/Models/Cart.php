<?php
namespace App\Models;

class Cart {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO carts (user_id, items) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
json_encode($data['items'])
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM carts WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetch();
}

public function update($id, array $items) {
$stmt = $this->db->prepare("UPDATE carts SET items = ? WHERE id = ?");
return $stmt->execute([json_encode($items), $id]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM carts WHERE id = ?");
return $stmt->execute([$id]);
}
}