<?php
return [
'GET' => [
'/' => ['HomeController', 'index'],
'/products' => ['ProductController', 'index'],
'/product/{id}' => ['ProductController', 'show'],
'/cart' => ['CartController', 'index'],
'/orders' => ['OrderController', 'index'],
'/blog' => ['BlogController', 'index'],
'/blog/{id}' => ['BlogController', 'show'],
'/admin/dashboard' => ['AdminDashboardController', 'index'],
'/admin/users' => ['AdminUserController', 'index'],
'/admin/products' => ['AdminController', 'products'],
'/api/products' => ['Api/ProductApiController', 'getProducts'],
],
'POST' => [
'/cart/add' => ['CartController', 'add'],
'/cart/remove' => ['CartController', 'remove'],
'/orders/create' => ['OrderController', 'create'],
'/auth/login' => ['AuthController', 'login'],
'/auth/register' => ['AuthController', 'register'],
'/admin/users/create' => ['AdminUserController', 'create'],
],
];