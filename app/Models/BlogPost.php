<?php
namespace App\Models;

class BlogPost {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(array $data) {
        $stmt = $this->db->prepare("INSERT INTO blog_posts (title, content, author_id, category_id, tags, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $data['author_id'] ?? null,
            $data['category_id'] ?? null,
            json_encode($data['tags'] ?? []),
            date('Y-m-d H:i:s') // برای created_at
        ]);
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllWithTranslations($lang) {
        $stmt = $this->db->prepare("
            SELECT p.id, COALESCE(pt.title, p.title) as title, COALESCE(pt.content, p.content) as content,
                   p.author_id, p.category_id, p.tags, p.created_at
            FROM blog_posts p
            LEFT JOIN post_translations pt ON p.id = pt.post_id AND pt.lang = ?
        ");
        $stmt->execute([$lang]);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByCategory($categoryId) {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE category_id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll();
    }

    public function update($id, array $data) {
        $stmt = $this->db->prepare("UPDATE blog_posts SET title = ?, content = ?, category_id = ?, tags = ?, author_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $data['category_id'] ?? null,
            json_encode($data['tags'] ?? []),
            $data['author_id'] ?? null,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM blog_posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}