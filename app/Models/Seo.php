<?php
namespace App\Models;

class Seo {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO seo (page_id, meta_title, meta_description, keywords) VALUES (?, ?, ?, ?)");
return $stmt->execute([
$data['page_id'],
$data['meta_title'],
$data['meta_description'],
json_encode($data['keywords'] ?? [])
]);
}

public function getByPageId($pageId) {
$stmt = $this->db->prepare("SELECT * FROM seo WHERE page_id = ?");
$stmt->execute([$pageId]);
return $stmt->fetch();
}

public function update($id, array $data) {
$stmt = $this->db->prepare("UPDATE seo SET meta_title = ?, meta_description = ?, keywords = ? WHERE id = ?");
return $stmt->execute([
$data['meta_title'],
$data['meta_description'],
json_encode($data['keywords'] ?? []),
$id
]);
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM seo WHERE id = ?");
return $stmt->execute([$id]);
}
}