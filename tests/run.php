<?php
require_once __DIR__ . '/ProductControllerTest.php';
require_once __DIR__ . '/DiscountTest.php';
require_once __DIR__ . '/PaymentControllerTest.php';

echo "Running all tests...\n";

(new ProductControllerTest())->run();
(new DiscountTest())->run();
(new PaymentControllerTest())->run();

echo "All tests completed!\n";