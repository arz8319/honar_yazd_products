<?php
namespace App\Models;

class Seller {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO sellers (name, email) VALUES (?, ?)");
return $stmt->execute([
$data['name'],
$data['email']
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM sellers");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM sellers WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE sellers SET name = ?, email = ? WHERE id = ?");
return $stmt->execute([
$data['name'],
$data['email'],
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM sellers WHERE id = ?");
return $stmt->execute([$id]);
}
}