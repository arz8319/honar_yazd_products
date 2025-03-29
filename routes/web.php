<?php
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\OrderController;
use App\Controllers\BlogController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\PageController;
use App\Controllers\LanguageController;
use App\Controllers\LogoutController;
use App\Controllers\ProfileController;
use App\Controllers\PollController;
use App\Controllers\TicketController;
use App\Controllers\PaymentController;
use App\Controllers\NotificationController;

$routes = [
    'GET' => [
        // مسیرهای اصلی سایت
        '/' => [HomeController::class, 'index'],
        '/index.php' => [HomeController::class, 'index'],
        '/products' => [ProductController::class, 'index'],
        '/product/(\d+)' => [ProductController::class, 'show'],
        '/cart' => [CartController::class, 'index'],
        '/orders' => [OrderController::class, 'index'],
        '/blog' => [BlogController::class, 'index'],
        '/blog/(\d+)' => [BlogController::class, 'show'],
        '/auth/login' => [AuthController::class, 'login'],
        '/auth/register' => [AuthController::class, 'register'],
        '/(about-us|contact-us)' => [PageController::class, 'show'],
        '/language' => [LanguageController::class, 'change'],
        '/logout' => [LogoutController::class, 'logout'],
        '/profile' => [ProfileController::class, 'index'],
        '/profile/edit' => [ProfileController::class, 'edit'],
        '/polls' => [PollController::class, 'index'],
        '/tickets' => [TicketController::class, 'index'],
        '/tickets/create' => [TicketController::class, 'create'],
        '/tickets/(\d+)' => [TicketController::class, 'show'],
        '/payment/initiate/(\d+)' => [PaymentController::class, 'initiate'],
        '/payment/verify/(\d+)' => [PaymentController::class, 'verify'],
        '/notifications' => [NotificationController::class, 'index'],
        '/notifications/delete/(\d+)' => [NotificationController::class, 'delete'],

        // مسیرهای پنل مدیریت (با AdminController)
        '/admin' => [AdminController::class, 'dashboard'],
        '/admin/login' => [AdminController::class, 'login'],
        '/admin/logout' => [AdminController::class, 'logout'],
        '/admin/products' => [AdminController::class, 'products'],
        '/admin/add-product' => [AdminController::class, 'addProduct'],
        '/admin/edit-product/(\d+)' => [AdminController::class, 'editProduct'],
        '/admin/delete-product/(\d+)' => [AdminController::class, 'deleteProduct'],
        '/admin/orders' => [AdminController::class, 'orders'],
        '/admin/view-order/(\d+)' => [AdminController::class, 'viewOrder'],
        '/admin/categories' => [AdminController::class, 'categories'],
        '/admin/add-category' => [AdminController::class, 'addCategory'],
        '/admin/edit-category/(\d+)' => [AdminController::class, 'editCategory'],
        '/admin/delete-category/(\d+)' => [AdminController::class, 'deleteCategory'],
        '/admin/reviews' => [AdminController::class, 'reviews'],
        '/admin/users' => [AdminController::class, 'users'],
        '/admin/add-user' => [AdminController::class, 'addUser'],
        '/admin/edit-user/(\d+)' => [AdminController::class, 'editUser'],
        '/admin/delete-user/(\d+)' => [AdminController::class, 'deleteUser'],
        '/admin/discounts' => [AdminController::class, 'discounts'],
        '/admin/add-discount' => [AdminController::class, 'addDiscount'],
        '/admin/edit-discount/(\d+)' => [AdminController::class, 'editDiscount'],
        '/admin/delete-discount/(\d+)' => [AdminController::class, 'deleteDiscount'],
        '/admin/reports' => [AdminController::class, 'reports'],
        '/admin/settings' => [AdminController::class, 'settings'],
        '/admin/update-prices' => [AdminController::class, 'updatePrices'],
    ],
    'POST' => [
        // مسیرهای اصلی سایت
        '/cart/add' => [CartController::class, 'add'],
        '/cart/remove' => [CartController::class, 'remove'],
        '/orders/create' => [OrderController::class, 'create'],
        '/auth/login' => [AuthController::class, 'login'],
        '/auth/register' => [AuthController::class, 'register'],
        '/contact/submit' => [PageController::class, 'submitContact'],
        '/profile/edit' => [ProfileController::class, 'edit'],
        '/polls/vote' => [PollController::class, 'vote'],
        '/tickets/create' => [TicketController::class, 'create'],
        '/tickets/reply' => [TicketController::class, 'reply'],

        // مسیرهای پنل مدیریت (با AdminController)
        '/admin/login' => [AdminController::class, 'login'],
        '/admin/add-product' => [AdminController::class, 'addProduct'],
        '/admin/edit-product/(\d+)' => [AdminController::class, 'editProduct'],
        '/admin/add-category' => [AdminController::class, 'addCategory'],
        '/admin/edit-category/(\d+)' => [AdminController::class, 'editCategory'],
        '/admin/add-user' => [AdminController::class, 'addUser'],
        '/admin/edit-user/(\d+)' => [AdminController::class, 'editUser'],
        '/admin/add-discount' => [AdminController::class, 'addDiscount'],
        '/admin/edit-discount/(\d+)' => [AdminController::class, 'editDiscount'],
        '/admin/update-prices' => [AdminController::class, 'updatePrices'],
    ]
];

return $routes;