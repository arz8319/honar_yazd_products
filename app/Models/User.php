<?php
namespace App\Models;

use App\Database;

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $username, $email, $password, $role = 'customer', $created_at = null) {
        $stmt = $this->db->prepare("INSERT INTO users (name, username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $username,
            $email,
            $password,
            $role,
            $created_at ?? date('Y-m-d H:i:s')
        ]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $username, $email, $password, $role, $created_at = null) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, username = ?, email = ?, password = ?, role = ?, created_at = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $username,
            $email,
            $password,
            $role,
            $created_at ?? date('Y-m-d H:i:s'),
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}