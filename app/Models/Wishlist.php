<?php
namespace App\Models;

class Wishlist {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO wishlists (user_id, product_id) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['product_id']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM wishlists WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM wishlists WHERE id = ?");
return $stmt->execute([$id]);
}
}