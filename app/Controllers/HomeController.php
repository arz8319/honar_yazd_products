<?php
namespace App\Controllers;

class HomeController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // لود کردن زبان
        $locale = isset($_GET['locale']) ? $_GET['locale'] : ($_SESSION['locale'] ?? 'fa');
        $_SESSION['locale'] = $locale;

        // لود کردن ترجمه‌ها از دیتابیس
        $stmt = $this->db->prepare("SELECT key, value FROM translations WHERE lang = ?");
        $stmt->execute([$locale]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $translations = [];
        foreach ($rows as $row) {
            $translations[$row['key']] = $row['value'];
        }
        $_SESSION['translations'] = $translations;

        // تعریف تابع trans()
        if (!function_exists('trans')) {
            function trans($key) {
                $translations = $_SESSION['translations'] ?? [];
                return isset($translations[$key]) ? $translations[$key] : $key;
            }
        }

        // لود کردن محصولات (محدود به 3 محصول)
        $stmt = $this->db->query("SELECT * FROM products LIMIT 3");
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // تنظیم عنوان صفحه
        $title = trans('title_default');

        // رندر صفحه اصلی
        ob_start();
        require __DIR__ . '/../../resources/views/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }
}