<?php

use App\Controllers\Api\ProductApiController;
use App\Controllers\Api\MobileApiController;
use App\Controllers\Api\AuthApiController;
use App\Controllers\Api\OrderApiController;
use App\Controllers\Api\CartApiController;

$routes = [
'GET' => [
'/api/products' => [ProductApiController::class, 'getProducts'],
'/api/mobile/products' => [MobileApiController::class, 'getProducts'],
'/api/mobile/cart/(\d+)' => [MobileApiController::class, 'getCart'],
'/api/mobile/total/(\d+)' => [MobileApiController::class, 'calculateTotal'],
'/api/orders/(\d+)' => [OrderApiController::class, 'getOrders'],
],
'POST' => [
'/api/auth/login' => [AuthApiController::class, 'login'],
'/api/orders' => [OrderApiController::class, 'create'],
'/api/cart/add' => [CartApiController::class, 'add'],
'/api/cart/remove' => [CartApiController::class, 'remove'],
]
];