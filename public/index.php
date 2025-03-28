<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

session_start();

$config = require __DIR__ . '/../config/database.php';
$db = new Database($config);

// Set default locale
$settingsStmt = $db->query("SELECT `value` FROM settings WHERE `key` = ?", ['default_locale']);
$defaultLocale = $settingsStmt->fetch()['value'] ?? 'fa';
$_SESSION['locale'] = $_SESSION['locale'] ?? $defaultLocale;

// Handle language change
if (isset($_GET['locale'])) {
$_SESSION['locale'] = $_GET['locale'];
header('Location: ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
exit;
}

$webRoutes = require __DIR__ . '/../routes/web.php';
$apiRoutes = require __DIR__ . '/../routes/api.php';

$router = new Router($webRoutes);
$apiRouter = new Router($apiRoutes);

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$handler = null;
if (strpos($uri, '/api') === 0) {
$handler = $apiRouter->dispatch($method, $uri);
} else {
$handler = $router->dispatch($method, $uri);
}

use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;

if ($handler) {
[$controllerClass, $method, $params] = $handler;

$controller = new $controllerClass($db);

$protectedRoutes = ['/cart', '/orders', '/api/orders', '/api/cart/add', '/api/cart/remove'];
$adminRoutes = ['/admin/dashboard', '/admin/users', '/admin/products'];

$next = function () use ($controller, $method, $params) {
call_user_func_array([$controller, $method], $params);
};

if (in_array($uri, $adminRoutes) || (isset($handler[0]) && strpos($uri, '/admin') === 0)) {
AdminMiddleware::handle($next, $db);
} elseif (in_array($uri, $protectedRoutes) || (isset($handler[0]) && strpos($uri, '/api/orders') === 0)) {
AuthMiddleware::handle($next);
} else {
$next();
}
} else {
http_response_code(404);
require __DIR__ . '/../resources/views/errors/404.php';
}