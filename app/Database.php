<?php
namespace App;

class Database {
    private $connection;

    public function getConnection() {
        try {
            $dbPath = __DIR__ . '/../database.sqlite';
            $this->connection = new \PDO("sqlite:$dbPath");
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function query($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}