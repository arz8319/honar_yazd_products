<?php
namespace App\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;

class TicketController {
    private $db;
    private $ticketModel;
    private $ticketReplyModel;

    public function __construct($db) {
        $this->db = $db;
        $this->ticketModel = new Ticket($db);
        $this->ticketReplyModel = new TicketReply($db);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $tickets = $this->ticketModel->getByUserId($_SESSION['user_id']);
        $locale = $_SESSION['locale'] ?? 'fa';
        $title = $locale === 'fa' ? 'تیکت‌ها' : 'Tickets';
        ob_start();
        require __DIR__ . '/../../resources/views/tickets/index.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($subject) || empty($description)) {
                $error = $_SESSION['locale'] === 'fa' ? 'لطفاً همه فیلدها را پر کنید.' : 'Please fill in all fields.';
                $locale = $_SESSION['locale'] ?? 'fa';
                $title = $locale === 'fa' ? 'ایجاد تیکت' : 'Create Ticket';
                ob_start();
                require __DIR__ . '/../../resources/views/tickets/create.php';
                $content = ob_get_clean();
                require __DIR__ . '/../../resources/views/layouts/app.php';
                return;
            }

            if (strlen($subject) > 255) {
                $error = $_SESSION['locale'] === 'fa' ? 'موضوع نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.' : 'Subject cannot be longer than 255 characters.';
                $locale = $_SESSION['locale'] ?? 'fa';
                $title = $locale === 'fa' ? 'ایجاد تیکت' : 'Create Ticket';
                ob_start();
                require __DIR__ . '/../../resources/views/tickets/create.php';
                $content = ob_get_clean();
                require __DIR__ . '/../../resources/views/layouts/app.php';
                return;
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'subject' => $subject,
                'description' => $description
            ];
            $this->ticketModel->create($data);
            header('Location: /honar_yazd_products/tickets');
        } else {
            $locale = $_SESSION['locale'] ?? 'fa';
            $title = $locale === 'fa' ? 'ایجاد تیکت' : 'Create Ticket';
            ob_start();
            require __DIR__ . '/../../resources/views/tickets/create.php';
            $content = ob_get_clean();
            require __DIR__ . '/../../resources/views/layouts/app.php';
        }
    }

    public function show($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        $ticket = $this->ticketModel->getById($id);
        if (!$ticket || $ticket['user_id'] != $_SESSION['user_id']) {
            header('Location: /honar_yazd_products/tickets');
            exit;
        }

        $replies = $this->ticketReplyModel->getByTicketId($id);
        $locale = $_SESSION['locale'] ?? 'fa';
        $title = $locale === 'fa' ? 'جزئیات تیکت' : 'Ticket Details';
        ob_start();
        require __DIR__ . '/../../resources/views/tickets/show.php';
        $content = ob_get_clean();
        require __DIR__ . '/../../resources/views/layouts/app.php';
    }

    public function reply() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /honar_yazd_products/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = $_POST['ticket_id'];
            $reply = trim($_POST['reply'] ?? '');

            if (empty($reply)) {
                header('Location: /honar_yazd_products/tickets/' . $ticketId . '?error=empty_reply');
                exit;
            }

            $ticket = $this->ticketModel->getById($ticketId);
            if (!$ticket || $ticket['user_id'] != $_SESSION['user_id']) {
                header('Location: /honar_yazd_products/tickets');
                exit;
            }

            $this->ticketReplyModel->create([
                'ticket_id' => $ticketId,
                'user_id' => $_SESSION['user_id'],
                'reply' => $reply
            ]);
            header('Location: /honar_yazd_products/tickets/' . $ticketId);
        }
    }
}