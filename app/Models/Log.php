<?php
namespace App\Models;

class Log {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO logs (event, data) VALUES (?, ?)");
return $stmt->execute([
$data['event'],
json_encode($data['data'])
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM logs");
$stmt->execute();
return $stmt->fetchAll();
}
}