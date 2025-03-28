<?php
namespace App\Controllers;

use App\Models\Cart;
use App\Models\Discount;

class CartController {
    private $db;
    private $cartModel;
    private $discountModel;

    public function __construct($db) {
        $this->db = $db;
        $this->cartModel = new Cart($db);
        $this->discountModel = new Discount($db);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $cart = $this->cartModel->getByUserId($_SESSION['user_id']);
        $items = $cart ? json_decode($cart['items'], true) : [];
        $products = [];

        $total = 0;
        foreach ($items as $productId => $quantity) {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($product) {
                $discount = $this->discountModel->getByProductId($productId);
                $price = $product['price'];
                if ($discount) {
                    $product['original_price'] = $price;
                    $price = $price * (1 - $discount['percentage'] / 100);
                    $product['discount_percentage'] = $discount['percentage'];
                }
                $product['price'] = $price;
                $product['quantity'] = $quantity;
                $products[] = $product;
                $total += $price * $quantity;
            }
        }

        $locale = $_SESSION['locale'] ?? 'fa';
        $title = $locale === 'fa' ? 'سبد خرید' : 'Cart';
        ob_start();
        require __DIR__ . '/../../resources/views/cart/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }

    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'] ?? 1;

        $cart = $this->cartModel->getByUserId($_SESSION['user_id']);
        if (!$cart) {
            $this->cartModel->create(['user_id' => $_SESSION['user_id'], 'items' => []]);
            $cart = $this->cartModel->getByUserId($_SESSION['user_id']);
        }

        $items = json_decode($cart['items'], true);
        $items[$productId] = ($items[$productId] ?? 0) + $quantity;
        $this->cartModel->update($cart['id'], $items);

        header('Location: /honar_yazd_products/cart');
    }

    public function remove() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $productId = $_POST['product_id'];

        $cart = $this->cartModel->getByUserId($_SESSION['user_id']);
        if ($cart) {
            $items = json_decode($cart['items'], true);
            unset($items[$productId]);
            $this->cartModel->update($cart['id'], $items);
        }

        header('Location: /honar_yazd_products/cart');
    }
}