<?php
namespace App\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;

class PollController {
private $db;
private $pollModel;
private $pollOptionModel;
private $pollVoteModel;

public function __construct($db) {
$this->db = $db;
$this->pollModel = new Poll($db);
$this->pollOptionModel = new PollOption($db);
$this->pollVoteModel = new PollVote($db);
}

public function index() {
$polls = $this->pollModel->getAll();
foreach ($polls as &$poll) {
$poll['options'] = $this->pollOptionModel->getByPollId($poll['id']);
}
require __DIR__ . '/../../resources/views/polls/index.php';
}

public function vote() {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
header('Location: /auth/login');
exit;
}

$pollId = $_POST['poll_id'];
$optionId = $_POST['option_id'];

$existingVote = $this->pollVoteModel->getByUserAndPoll($userId, $pollId);
if ($existingVote) {
header('Location: /polls?error=already_voted');
exit;
}

$this->pollVoteModel->create([
'poll_id' => $pollId,
'user_id' => $userId,
'option_id' => $optionId
]);

$this->pollOptionModel->incrementVotes($optionId);
header('Location: /polls');
}
}
}