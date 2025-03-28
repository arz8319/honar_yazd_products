<?php
namespace App\Models;

class Order {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($user_id, $total_price, $status = 'pending') {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)");
        $result = $stmt->execute([$user_id, $total_price, $status]);
        if ($result) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function addItem($order_id, $product_id, $quantity, $price) {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$order_id, $product_id, $quantity, $price]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT o.*, u.name as user_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT o.*, u.name as user_name FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT o.*, u.name as user_name FROM orders o JOIN users u ON o.user_id = u.id WHERE o.user_id = ? ORDER BY o.created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getItems($order_id) {
        $stmt = $this->db->prepare("SELECT oi.*, p.title as product_title FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getSalesReport($start_date, $end_date) {
        $stmt = $this->db->prepare("SELECT DATE(created_at) as sale_date, SUM(total_price) as total_sales, COUNT(*) as order_count FROM orders WHERE created_at BETWEEN ? AND ? GROUP BY DATE(created_at)");
        $stmt->execute([$start_date, $end_date]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

public function count() {
    $stmt = $this->db->query("SELECT COUNT(*) FROM orders");
    return $stmt->fetchColumn();
}
}