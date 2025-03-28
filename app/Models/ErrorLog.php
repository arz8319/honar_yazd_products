<?php
namespace App\Models;

class ErrorLog {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO error_logs (error) VALUES (?)");
return $stmt->execute([$data['error']]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM error_logs");
$stmt->execute();
return $stmt->fetchAll();
}
}