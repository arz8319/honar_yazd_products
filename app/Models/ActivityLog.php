<?php
namespace App\Models;

use App\Database;

class ActivityLog {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function log($user_id, $action, $details) {
        $stmt = $this->db->prepare("INSERT INTO activity_logs (user_id, action, details) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $action, $details]);
    }

    public function getRecent($limit) {
        $stmt = $this->db->prepare("SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}