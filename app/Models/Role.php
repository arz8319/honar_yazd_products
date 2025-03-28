<?php
namespace App\Models;

class Role {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO roles (name) VALUES (?)");
return $stmt->execute([$data['name']]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM roles");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM roles WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE roles SET name = ? WHERE id = ?");
return $stmt->execute([$data['name'], $id]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM roles WHERE id = ?");
return $stmt->execute([$id]);
}
}