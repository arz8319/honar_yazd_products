<?php
namespace App\Models;

class Page {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO pages (title, slug, content) VALUES (?, ?, ?)");
return $stmt->execute([
$data['title'],
$data['slug'],
$data['content']
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM pages");
$stmt->execute();
return $stmt->fetchAll();
}

public function getById($id) {
$stmt = $this->db->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
}

public function getBySlug($slug) {
$stmt = $this->db->prepare("SELECT * FROM pages WHERE slug = ?");
$stmt->execute([$slug]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE pages SET title = ?, slug = ?, content = ? WHERE id = ?");
return $stmt->execute([
$data['title'],
$data['slug'],
$data['content'],
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM pages WHERE id = ?");
return $stmt->execute([$id]);
}
}