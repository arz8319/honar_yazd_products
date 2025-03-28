<?php
namespace App\Models;

class SystemLog {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO system_logs (event) VALUES (?)");
return $stmt->execute([$data['event']]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM system_logs");
$stmt->execute();
return $stmt->fetchAll();
}
}