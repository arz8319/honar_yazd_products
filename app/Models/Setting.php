<?php
namespace App\Models;

class Setting {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function get($name) {
        $stmt = $this->db->prepare("SELECT value FROM settings WHERE name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result['value'] : null;
    }

    public function set($name, $value) {
        $stmt = $this->db->prepare("INSERT INTO settings (name, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = ?, updated_at = CURRENT_TIMESTAMP");
        return $stmt->execute([$name, $value, $value]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM settings");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}