<?php
namespace App\Models;

class Permission {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO permissions (role_id, permission) VALUES (?, ?)");
return $stmt->execute([
$data['role_id'],
$data['permission']
]);
}

public function getByRoleId($roleId) {
$stmt = $this->db->prepare("SELECT * FROM permissions WHERE role_id = ?");
$stmt->execute([$roleId]);
return $stmt->fetchAll();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM permissions WHERE id = ?");
return $stmt->execute([$id]);
}
}