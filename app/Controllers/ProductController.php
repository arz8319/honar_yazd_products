<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;

class ProductController {
    private $db;
    private $productModel;
    private $categoryModel;
    private $discountModel;

    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new Product($db);
        $this->categoryModel = new Category($db);
        $this->discountModel = new Discount($db);
    }

    public function index() {
        $search = $_GET['search'] ?? '';
        $categoryId = $_GET['category_id'] ?? '';

        $query = "SELECT * FROM products WHERE 1=1";
        $params = [];

        if ($search) {
            $query .= " AND (title LIKE ? OR description LIKE ?)";
            $params[] = "%{$search}%";
            $params[] = "%{$search}%";
        }

        if ($categoryId) {
            $query .= " AND category_id = ?";
            $params[] = $categoryId;
        }

        // Use prepare and execute instead of query
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = $this->categoryModel->getAll();

        foreach ($products as &$product) {
            $discount = $this->discountModel->getByProductId($product['id']);
            if ($discount) {
                $product['original_price'] = $product['price'];
                $product['price'] = $product['price'] * (1 - $discount['percentage'] / 100);
                $product['discount_percentage'] = $discount['percentage'];
            }
        }

        // Load the view with layout
        $locale = $_SESSION['locale'] ?? 'fa';
        $title = $locale === 'fa' ? 'محصولات' : 'Products';
        $baseUrl = '/honar_yazd_products'; // اضافه کردن baseUrl برای استفاده توی ویو
        ob_start();
        require __DIR__ . '/../../resources/views/products/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }

    public function show($id) {
        $product = $this->productModel->findById($id); // تغییر getById به findById
        if (!$product) {
            http_response_code(404);
            require __DIR__ . '/../../resources/views/errors/404.php';
            return;
        }

        $discount = $this->discountModel->getByProductId($product['id']);
        if ($discount) {
            $product['original_price'] = $product['price'];
            $product['price'] = $product['price'] * (1 - $discount['percentage'] / 100);
            $product['discount_percentage'] = $discount['percentage'];
        }

        // Load the view with layout
        $locale = $_SESSION['locale'] ?? 'fa';
        $baseUrl = '/honar_yazd_products'; // اضافه کردن baseUrl برای استفاده توی ویو
        $title = $locale === 'fa' ? 'جزئیات محصول' : 'Product Details';
        ob_start();
        require __DIR__ . '/../../resources/views/products/show.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }
}