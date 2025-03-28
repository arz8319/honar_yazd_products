<?php
namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
public static function handle($next) {
if (!isset($_SESSION['jwt'])) {
header('Location: /auth/login');
exit;
}

try {
$decoded = JWT::decode($_SESSION['jwt'], new Key(getenv('APP_KEY'), 'HS256'));
$_SESSION['user_id'] = $decoded->user_id;
return $next();
} catch (\Exception $e) {
header('Location: /auth/login');
exit;
}
}
}