<?php
function __($key) {
    static $translations = [];
    $lang = $_SESSION['locale'] ?? 'en';

    if (!isset($translations[$lang])) {
        $db = new \App\Database();
        $connection = $db->getConnection();
        $stmt = $connection->prepare("SELECT key, value FROM translations WHERE lang = ?");
        $stmt->execute([$lang]);
        $translations[$lang] = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $translations[$lang][$row['key']] = $row['value'];
        }
    }

    return $translations[$lang][$key] ?? $key;
}