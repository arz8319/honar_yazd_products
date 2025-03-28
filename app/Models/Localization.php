<?php
namespace App\Models;

class Localization {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO localizations (`key`, locale, `value`) VALUES (?, ?, ?)");
return $stmt->execute([
$data['key'],
$data['locale'],
$data['value']
]);
}

public function getByKeyAndLocale($key, $locale) {
$stmt = $this->db->prepare("SELECT * FROM localizations WHERE `key` = ? AND locale = ?");
$stmt->execute([$key, $locale]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE localizations SET `value` = ? WHERE id = ?");
return $stmt->execute([
$data['value'],
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM localizations WHERE id = ?");
return $stmt->execute([$id]);
}
}