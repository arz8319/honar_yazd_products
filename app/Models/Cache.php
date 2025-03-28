<?php
namespace App\Models;

class Cache {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO cache (`key`, `value`) VALUES (?, ?)");
return $stmt->execute([
$data['key'],
$data['value']
]);
}

public function getByKey($key) {
$stmt = $this->db->prepare("SELECT * FROM cache WHERE `key` = ?");
$stmt->execute([$key]);
return $stmt->fetch();
}

public function update($key, $value) {
$stmt = $this->db->prepare("UPDATE cache SET `value` = ? WHERE `key` = ?");
return $stmt->execute([$value, $key]);
}

public function delete($key) {
$stmt = $this->db->prepare("DELETE FROM cache WHERE `key` = ?");
return $stmt->execute([$key]);
}
}