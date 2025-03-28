<?php
namespace App\Models;

use PDO;

class Report {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(array $data) {
        $stmt = $this->db->prepare("INSERT INTO reports (type, data) VALUES (?, ?)");
        return $stmt->execute([
            $data['type'],
            json_encode($data['data'])
        ]);
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM reports");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // مشخص کردن fetchMode
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM reports WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // مشخص کردن fetchMode
    }
}