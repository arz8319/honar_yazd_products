<?php
namespace App\Models;

class TicketReply {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO ticket_replies (ticket_id, user_id, reply) VALUES (?, ?, ?)");
return $stmt->execute([
$data['ticket_id'],
$data['user_id'],
$data['reply']
]);
}

public function getByTicketId($ticketId) {
$stmt = $this->db->prepare("SELECT tr.*, u.name as user_name FROM ticket_replies tr JOIN users u ON tr.user_id = u.id WHERE ticket_id = ?");
$stmt->execute([$ticketId]);
return $stmt->fetchAll();
}
}