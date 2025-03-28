<?php
namespace App\Controllers;

use App\Models\Notification;

require_once 'app/helpers.php';

class NotificationController {
    private $db;
    private $notificationModel;

    public function __construct($db) {
        $this->db = $db;
        $this->notificationModel = new Notification($db);
    }

    public function index() {
        $baseUrl = '/honar_yazd_products';
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $notifications = $this->notificationModel->getByUserId($_SESSION['user_id']);
        $locale = $_SESSION['locale'] ?? 'fa';
        $title = __('notifications'); // استفاده از تابع __() برای ترجمه
        ob_start();
        require __DIR__ . '/../../resources/views/notifications/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }

    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE id = ?");
        $stmt->execute([$id]);
        $notification = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($notification && $notification['user_id'] == $_SESSION['user_id']) {
            $this->notificationModel->delete($id);
            header('Location: /honar_yazd_products/notifications?success=deleted');
        } else {
            header('Location: /honar_yazd_products/notifications?error=not_found');
        }
    }
}