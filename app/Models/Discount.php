<?php
namespace App\Models;

class Discount {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($product_id, $category_id, $percentage, $start_date, $end_date) {
        $stmt = $this->db->prepare("INSERT INTO discounts (product_id, category_id, percentage, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$product_id, $category_id, $percentage, $start_date, $end_date]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT d.*, p.title as product_title, c.name as category_name FROM discounts d LEFT JOIN products p ON d.product_id = p.id LEFT JOIN categories c ON d.category_id = c.id ORDER BY d.created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT d.*, p.title as product_title, c.name as category_name FROM discounts d LEFT JOIN products p ON d.product_id = p.id LEFT JOIN categories c ON d.category_id = c.id WHERE d.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByProductId($product_id) {
        $stmt = $this->db->prepare("SELECT * FROM discounts WHERE product_id = ? AND start_date <= NOW() AND end_date >= NOW()");
        $stmt->execute([$product_id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByCategoryId($category_id) {
        $stmt = $this->db->prepare("SELECT * FROM discounts WHERE category_id = ? AND start_date <= NOW() AND end_date >= NOW()");
        $stmt->execute([$category_id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $product_id, $category_id, $percentage, $start_date, $end_date) {
        $stmt = $this->db->prepare("UPDATE discounts SET product_id = ?, category_id = ?, percentage = ?, start_date = ?, end_date = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$product_id, $category_id, $percentage, $start_date, $end_date, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM discounts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}