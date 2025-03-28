<?php
namespace App\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;

class AuthController {
    private $db;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($db);
    }

    public function login() {
        $baseUrl = '/honar_yazd_products';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $payload = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'exp' => time() + 3600
                ];
                $appKey = getenv('APP_KEY') ?: 'default-secret-key-1234567890';
                if (!$appKey) {
                    throw new Exception('APP_KEY is not set in .env file');
                }
                $jwt = JWT::encode($payload, $appKey, 'HS256');
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['jwt'] = $jwt;
                header('Location: /honar_yazd_products/');
            } else {
                $error = $_SESSION['locale'] === 'fa' ? 'ایمیل یا رمز عبور اشتباه است.' : 'Invalid credentials';
                $locale = $_SESSION['locale'] ?? 'fa';
                $title = $locale === 'fa' ? 'ورود' : 'Login';
                ob_start();
                require __DIR__ . '/../../resources/views/auth/login.php';
                $content = ob_get_clean();
                require __DIR__ . '/../../resources/views/layouts/app.php';
            }
        } else {
            $locale = $_SESSION['locale'] ?? 'fa';
            $title = $locale === 'fa' ? 'ورود' : 'Login';
            ob_start();
            require __DIR__ . '/../../resources/views/auth/login.php';
            $content = ob_get_clean();
            require __DIR__ . '/../../resources/views/layouts/app.php';
        }
    }

    public function register() {
        $baseUrl = '/honar_yazd_products';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'username' => $_POST['username'], // اضافه کردن username
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role_id' => 1, // فرض می‌کنیم role_id=1 برای کاربر معمولی
                'created_at' => date('Y-m-d H:i:s') // تاریخ و زمان فعلی
            ];
            if ($this->userModel->create($data)) {
                header('Location: /honar_yazd_products/auth/login?success=registered');
            } else {
                $error = $_SESSION['locale'] === 'fa' ? 'ثبت‌نام ناموفق بود.' : 'Registration failed';
                $locale = $_SESSION['locale'] ?? 'fa';
                $title = $locale === 'fa' ? 'ثبت‌نام' : 'Register';
                ob_start();
                require __DIR__ . '/../../resources/views/auth/register.php';
                $content = ob_get_clean();
                require __DIR__ . '/../../resources/views/layouts/app.php';
            }
        } else {
            $locale = $_SESSION['locale'] ?? 'fa';
            $title = $locale === 'fa' ? 'ثبت‌نام' : 'Register';
            ob_start();
            require __DIR__ . '/../../resources/views/auth/register.php';
            $content = ob_get_clean();
            require __DIR__ . '/../../resources/views/layouts/app.php';
        }
    }

    public function language() {
        $locale = $_GET['locale'] ?? 'fa';
        $_SESSION['locale'] = in_array($locale, ['fa', 'en', 'ar']) ? $locale : 'fa';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/honar_yazd_products/'));
    }
}