<?php
namespace App\Models;

class PollOption {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO poll_options (poll_id, option_text) VALUES (?, ?)");
return $stmt->execute([
$data['poll_id'],
$data['option_text']
]);
}

public function getByPollId($pollId) {
$stmt = $this->db->prepare("SELECT * FROM poll_options WHERE poll_id = ?");
$stmt->execute([$pollId]);
return $stmt->fetchAll();
}

public function incrementVotes($optionId) {
$stmt = $this->db->prepare("UPDATE poll_options SET votes = votes + 1 WHERE id = ?");
return $stmt->execute([$optionId]);
}
}