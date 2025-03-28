<?php
namespace App\Models;

class Poll {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO polls (question) VALUES (?)");
return $stmt->execute([$data['question']]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM polls");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM polls WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}
}