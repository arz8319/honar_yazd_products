<?php
namespace App\Models;

class Campaign {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO campaigns (name, start_date, end_date) VALUES (?, ?, ?)");
return $stmt->execute([
$data['name'],
$data['start_date'],
$data['end_date']
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM campaigns");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM campaigns WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE campaigns SET name = ?, start_date = ?, end_date = ? WHERE id = ?");
return $stmt->execute([
$data['name'],
$data['start_date'],
$data['end_date'],
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM campaigns WHERE id = ?");
return $stmt->execute([$id]);
}
}