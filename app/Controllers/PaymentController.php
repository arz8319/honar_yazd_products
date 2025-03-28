<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Notification;

class PaymentController {
private $db;
private $orderModel;
private $paymentModel;
private $notificationModel;

public function __construct($db) {
$this->db = $db;
$this->orderModel = new Order($db);
$this->paymentModel = new Payment($db);
$this->notificationModel = new Notification($db);
}

public function initiate($orderId) {
if (!isset($_SESSION['user_id'])) {
header('Location: /auth/login');
exit;
}

$order = $this->orderModel->getById($orderId);
if (!$order || $order['user_id'] != $_SESSION['user_id']) {
header('Location: /orders');
exit;
}

$payment = $this->paymentModel->getByOrderId($orderId);
if (!$payment || $payment['status'] !== 'pending') {
header('Location: /orders');
exit;
}

// Simulate Zarinpal API request
$merchantId = getenv('ZARINPAL_MERCHANT_ID') ?: 'your-merchant-id';
$amount = $order['total'] * 10; // Convert to Rials (for Iran)
$callbackUrl = "http://yourdomain.com/payment/verify/{$orderId}";

$data = [
'merchant_id' => $merchantId,
'amount' => $amount,
'description' => "Payment for order #{$orderId}",
'callback_url' => $callbackUrl
];

$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);
if ($result['data']['code'] == 100) {
$authority = $result['data']['authority'];
header("Location: https://www.zarinpal.com/pg/StartPay/{$authority}");
} else {
header('Location: /orders?error=payment_failed');
}
}

public function verify($orderId) {
if (!isset($_SESSION['user_id'])) {
header('Location: /auth/login');
exit;
}

$order = $this->orderModel->getById($orderId);
if (!$order || $order['user_id'] != $_SESSION['user_id']) {
header('Location: /orders');
exit;
}

$payment = $this->paymentModel->getByOrderId($orderId);
if (!$payment || $payment['status'] !== 'pending') {
header('Location: /orders');
exit;
}

$authority = $_GET['Authority'];
$status = $_GET['Status'];

if ($status == 'OK') {
$merchantId = getenv('ZARINPAL_MERCHANT_ID') ?: 'your-merchant-id';
$amount = $order['total'] * 10; // Convert to Rials

$data = [
'merchant_id' => $merchantId,
'authority' => $authority,
'amount' => $amount
];

$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);
if ($result['data']['code'] == 100) {
$this->paymentModel->updateStatus($payment['id'], 'completed');
$this->orderModel->updateStatus($orderId, 'paid');

// Send notification
$this->notificationModel->create([
'user_id' => $order['user_id'],
'message' => $locale === 'fa' ? "پرداخت سفارش شماره {$orderId} با موفقیت انجام شد." : "Payment for order #{$orderId} was successful."
]);

header('Location: /orders?success=payment_completed');
} else {
header('Location: /orders?error=payment_failed');
}
} else {
header('Location: /orders?error=payment_cancelled');
}
}
}