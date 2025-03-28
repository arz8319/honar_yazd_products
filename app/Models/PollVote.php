<?php
namespace App\Models;

class PollVote {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO poll_votes (poll_id, user_id, option_id) VALUES (?, ?, ?)");
return $stmt->execute([
$data['poll_id'],
$data['user_id'],
$data['option_id']
]);
}

public function getByUserAndPoll($userId, $pollId) {
$stmt = $this->db->prepare("SELECT * FROM poll_votes WHERE user_id = ? AND poll_id = ?");
$stmt->execute([$userId, $pollId]);
return $stmt->fetch();
}
}