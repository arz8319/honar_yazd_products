<?php
namespace App\Models;

class Warehouse {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO warehouses (name, location) VALUES (?, ?)");
return $stmt->execute([
$data['name'],
$data['location']
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM warehouses");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM warehouses WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE warehouses SET name = ?, location = ? WHERE id = ?");
return $stmt->execute([
$data['name'],
$data['location'],
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM warehouses WHERE id = ?");
return $stmt->execute([$id]);
}
}