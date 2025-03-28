<?php
namespace App\Models;

class Survey {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO surveys (title, questions) VALUES (?, ?)");
return $stmt->execute([
$data['title'],
json_encode($data['questions'])
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM surveys");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM surveys WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM surveys WHERE id = ?");
return $stmt->execute([$id]);
}
}