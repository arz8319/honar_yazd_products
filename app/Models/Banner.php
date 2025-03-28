<?php
namespace App\Models;

class Banner {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO banners (title, image, link) VALUES (?, ?, ?)");
return $stmt->execute([
$data['title'],
$data['image'],
$data['link']
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM banners");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM banners WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE banners SET title = ?, image = ?, link = ? WHERE id = ?");
return $stmt->execute([
$data['title'],
$data['image'],
$data['link'],
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM banners WHERE id = ?");
return $stmt->execute([$id]);
}
}