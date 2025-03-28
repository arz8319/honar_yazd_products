<?php
namespace App\Middleware;

use App\Models\User;

class AdminMiddleware {
public static function handle($next, $db) {
if (!isset($_SESSION['user_id'])) {
header('Location: /auth/login');
exit;
}

$userModel = new User($db);
$user = $userModel->getById($_SESSION['user_id']);
if ($user['role_id'] != 1) {
header('Location: /');
exit;
}

return $next();
}
}