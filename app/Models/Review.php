<?php
namespace App\Models;

class Review {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($user_id, $product_id, $rating, $comment) {
        $stmt = $this->db->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $product_id, $rating, $comment]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT r.*, u.name as user_name, p.title as product_title FROM reviews r JOIN users u ON r.user_id = u.id JOIN products p ON r.product_id = p.id ORDER BY r.created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT r.*, u.name as user_name, p.title as product_title FROM reviews r JOIN users u ON r.user_id = u.id JOIN products p ON r.product_id = p.id WHERE r.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByProductId($productId) {
        $stmt = $this->db->prepare("SELECT r.*, u.name as user_name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ? AND r.status = 'approved' ORDER BY r.created_at DESC");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE reviews SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function addReply($review_id, $user_id, $reply) {
        $stmt = $this->db->prepare("INSERT INTO review_replies (review_id, user_id, reply) VALUES (?, ?, ?)");
        return $stmt->execute([$review_id, $user_id, $reply]);
    }

    public function getReplies($review_id) {
        $stmt = $this->db->prepare("SELECT rr.*, u.name as user_name FROM review_replies rr JOIN users u ON rr.user_id = u.id WHERE rr.review_id = ? ORDER BY rr.created_at");
        $stmt->execute([$review_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }

        public function countPending() {
    $stmt = $this->db->query("SELECT COUNT(*) FROM reviews WHERE status = 'pending'");
    return $stmt->fetchColumn();
}
}