<?php
namespace App\Controllers;

class HomeController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Fetch some data for the homepage (e.g., featured products)
        $stmt = $this->db->query("SELECT * FROM products LIMIT 3");
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Load the view
        $locale = $_SESSION['locale'] ?? 'fa';
        $title = $locale === 'fa' ? 'صفحه اصلی' : 'Home';
        ob_start();
        require __DIR__ . '/../../resources/views/home/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }
}