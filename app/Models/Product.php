<?php
namespace App\Models;

use App\Database;

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($title, $description, $price, $stock, $category_id, $seller_id, $images = '[]', $videos = '[]', $attributes = '[]') {
        $stmt = $this->db->prepare("INSERT INTO products (title, description, price, stock, category_id, seller_id, images, videos, attributes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $title,
            $description,
            $price,
            $stock,
            $category_id ?? null,
            $seller_id ?? null,
            $images,
            $videos,
            $attributes
        ]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByCategory($categoryId) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description, $price, $stock, $category_id, $seller_id, $images, $videos, $attributes) {
        $stmt = $this->db->prepare("UPDATE products SET title = ?, description = ?, price = ?, stock = ?, category_id = ?, seller_id = ?, images = ?, videos = ?, attributes = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([
            $title,
            $description,
            $price,
            $stock,
            $category_id ?? null,
            $seller_id ?? null,
            $images,
            $videos,
            $attributes,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updatePrice($product_id, $price) {
        $stmt = $this->db->prepare("UPDATE products SET price = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$price, $product_id]);
    }

    public function updatePricesByCategory($category_id, $percentage) {
        $multiplier = 1 + ($percentage / 100);
        $stmt = $this->db->prepare("UPDATE products SET price = price * ?, updated_at = CURRENT_TIMESTAMP WHERE category_id = ?");
        $stmt->execute([$multiplier, $category_id]);
    }

    public function count() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM products");
        return $stmt->fetchColumn();
    }
}