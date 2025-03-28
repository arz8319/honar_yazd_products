<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use App\Models\Ticket;
use PDO; // اضافه کردن PDO به فضای نام

class AdminDashboardController {
    private $db;
    private $userModel;
    private $orderModel;
    private $reportModel;
    private $ticketModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($db);
        $this->orderModel = new Order($db);
        $this->reportModel = new Report($db);
        $this->ticketModel = new Ticket($db);
    }

    public function index() {
        // چک کردن اینکه کاربر وارد شده و ادمین هست یا نه
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit;
        }

        // گرفتن نقش کاربر با استفاده از prepare و execute
        $query = "SELECT role_id FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // حالا PDO::FETCH_ASSOC درست کار می‌کنه

        // چک کردن نقش کاربر
        if (!$user || $user['role_id'] != 1) {
            header('Location: /auth/login');
            exit;
        }

        // گرفتن داده‌ها برای داشبورد
        $users = $this->userModel->getAll();
        $orders = $this->orderModel->getAll();
        $reports = $this->reportModel->getAll();
        $tickets = $this->ticketModel->getAll();

        require __DIR__ . '/../../resources/views/admin/dashboard.php';
    }
}