<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\Discount;

class OrderController {
    private $db;
    private $orderModel;
    private $cartModel;
    private $paymentModel;
    private $shippingModel;
    private $discountModel;

    public function __construct($db) {
        $this->db = $db;
        $this->orderModel = new Order($db);
        $this->cartModel = new Cart($db);
        $this->paymentModel = new Payment($db);
        $this->shippingModel = new Shipping($db);
        $this->discountModel = new Discount($db);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $orders = $this->orderModel->getByUserId($_SESSION['user_id']);
        $locale = $_SESSION['locale'] ?? 'fa';
        $title = $locale === 'fa' ? 'سفارش‌ها' : 'Orders';
        ob_start();
        require __DIR__ . '/../../resources/views/orders/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $cart = $this->cartModel->getByUserId($_SESSION['user_id']);
        if (!$cart) {
            header('Location: /honar_yazd_products/cart');
            exit;
        }

        $items = json_decode($cart['items'], true);
        if (empty($items)) {
            header('Location: /honar_yazd_products/cart');
            exit;
        }

        $total = 0;
        foreach ($items as $productId => $quantity) {
            $stmt = $this->db->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
            $discount = $this->discountModel->getByProductId($productId);
            $price = $product['price'];
            if ($discount) {
                $price = $price * (1 - $discount['percentage'] / 100);
            }
            $total += $price * $quantity;
        }

        $this->orderModel->create([
            'user_id' => $_SESSION['user_id'],
            'total' => $total
        ]);

        $orderId = $this->db->lastInsertId();
        $this->paymentModel->create([
            'order_id' => $orderId,
            'amount' => $total,
            'status' => 'pending',
            'gateway' => 'zarinpal'
        ]);

        $this->shippingModel->create([
            'order_id' => $orderId,
            'address' => $_POST['address'] ?? 'Default Address',
            'status' => 'pending'
        ]);

        $this->cartModel->update($cart['id'], []);
        header("Location: /honar_yazd_products/payment/initiate/{$orderId}");
    }
}