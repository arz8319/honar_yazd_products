<?php
namespace App\Models;

class Category {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $parent_id = null) {
        $stmt = $this->db->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
        return $stmt->execute([$name, $parent_id]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getHierarchy() {
        $categories = $this->getAll();
        $tree = [];
        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $category['children'] = [];
                $tree[$category['id']] = $category;
            }
        }
        foreach ($categories as $category) {
            if ($category['parent_id'] !== null && isset($tree[$category['parent_id']])) {
                $tree[$category['parent_id']]['children'][] = $category;
            }
        }
        return array_values($tree);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $parent_id = null) {
        $stmt = $this->db->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
        return $stmt->execute([$name, $parent_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function count() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM categories");
        return $stmt->fetchColumn();
    }
}