<?php
session_start();

// لود کردن autoload برای کتابخونه‌های Composer
require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// تنظیم لاگ
$log = new Logger('routing');
$log->pushHandler(new StreamHandler(__DIR__ . '/logs/debug.log', Logger::DEBUG));

// لود کردن متغیرهای محیطی از فایل .env با استفاده از phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Autoload classes برای کلاس‌های داخل App\
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Database connection
require_once __DIR__ . '/app/Database.php';
try {
    $db = (new App\Database())->getConnection();
} catch (\PDOException $e) {
    $log->error("Database connection failed: " . $e->getMessage());
    http_response_code(500);
    require __DIR__ . '/resources/views/errors/500.php';
    exit;
}

// Load routes
$routes = require __DIR__ . '/routes/web.php';

// Routing logic
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Adjust path for XAMPP (remove the directory prefix)
$basePath = '/honar_yazd_products';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath)) ?: '/';
}

// Find matching route
$handler = null;
if (isset($routes[$method]) && is_array($routes[$method])) {
    foreach ($routes[$method] as $pattern => $callback) {
        $pattern = preg_quote($pattern, '/');
        $pattern = str_replace('\(\d\+\)', '(\d+)', $pattern);
        $log->debug("Pattern = '$pattern', Path = '$path'");

        if (preg_match("/^$pattern$/", $path, $matches)) {
            $handler = $callback;
            array_shift($matches);
            break;
        }
    }
}

// Execute handler or show 404
if ($handler) {
    try {
        $controller = new $handler[0]($db);
        call_user_func_array([$controller, $handler[1]], $matches);
    } catch (Exception $e) {
        $log->error("Controller error: " . $e->getMessage());
        http_response_code(500);
        require __DIR__ . '/resources/views/errors/500.php';
    }
} else {
    http_response_code(404);
    require __DIR__ . '/resources/views/errors/404.php';
}