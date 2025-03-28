<?php
namespace App\Models;

use PDO;

class Ticket {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(array $data) {
        $stmt = $this->db->prepare("INSERT INTO tickets (user_id, subject, description, status) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['subject'],
            $data['description'],
            $data['status'] ?? 'open'
        ]);
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM tickets");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE tickets SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}