<?php
namespace App\Models;

class BlogComment {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO blog_comments (post_id, user_id, comment) VALUES (?, ?, ?)");
return $stmt->execute([
$data['post_id'],
$data['user_id'],
$data['comment']
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM blog_comments");
$stmt->execute();
return $stmt->fetchAll();
}

public function getByPostId($postId) {
$stmt = $this->db->prepare("SELECT * FROM blog_comments WHERE post_id = ?");
$stmt->execute([$postId]);
return $stmt->fetchAll();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM blog_comments WHERE id = ?");
return $stmt->execute([$id]);
}
}