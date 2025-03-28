<?php

class Database {
private $pdo;

public function __construct($config) {
$dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
$this->pdo = new PDO($dsn, $config['username'], $config['password']);
$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

public function prepare($query) {
return $this->pdo->prepare($query);
}

public function query($query, $params = []) {
$stmt = $this->pdo->prepare($query);
$stmt->execute($params);
return $stmt;
}

public function lastInsertId() {
return $this->pdo->lastInsertId();
}
}