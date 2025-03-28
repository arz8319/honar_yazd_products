<?php
namespace App\Models;

class Settings {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO settings (`key`, `value`) VALUES (?, ?)");
return $stmt->execute([
$data['key'],
$data['value']
]);
}

public function getByKey($key) {
$stmt = $this->db->prepare("SELECT * FROM settings WHERE `key` = ?");
$stmt->execute([$key]);
return $stmt->fetch();
}

public function update($key, $value) {
$stmt = $this->db->prepare("UPDATE settings SET `value` = ? WHERE `key` = ?");
return $stmt->execute([$value, $key]);
}
}