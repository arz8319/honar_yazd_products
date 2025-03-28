<?php
namespace App\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;

class AdminTicketController {
private $db;
private $ticketModel;
private $ticketReplyModel;

public function __construct($db) {
$this->db = $db;
$this->ticketModel = new Ticket($db);
$this->ticketReplyModel = new TicketReply($db);
}

public function index() {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

$tickets = $this->db->query("SELECT t.*, u.name as user_name FROM tickets t JOIN users u ON t.user_id = u.id")->fetchAll();
require __DIR__ . '/../../resources/views/admin/tickets/index.php';
}

public function show($id) {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

$ticket = $this->ticketModel->getById($id);
if (!$ticket) {
header('Location: /admin/tickets');
exit;
}

$replies = $this->ticketReplyModel->getByTicketId($id);
require __DIR__ . '/../../resources/views/admin/tickets/show.php';
}

public function reply() {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$ticketId = $_POST['ticket_id'];
$ticket = $this->ticketModel->getById($ticketId);
if (!$ticket) {
header('Location: /admin/tickets');
exit;
}

$this->ticketReplyModel->create([
'ticket_id' => $ticketId,
'user_id' => $_SESSION['user_id'],
'reply' => $_POST['reply']
]);

$this->ticketModel->updateStatus($ticketId, 'replied');
header('Location: /admin/tickets/' . $ticketId);
}
}

public function close($id) {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

$this->ticketModel->updateStatus($id, 'closed');
header('Location: /admin/tickets');
}
}