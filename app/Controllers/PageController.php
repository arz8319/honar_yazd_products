<?php
namespace App\Controllers;

use App\Models\Page;

class PageController {
private $db;
private $pageModel;

public function __construct($db) {
$this->db = $db;
$this->pageModel = new Page($db);
}

public function show($slug) {
$page = $this->pageModel->getBySlug($slug);
if (!$page) {
http_response_code(404);
require __DIR__ . '/../../resources/views/errors/404.php';
return;
}
require __DIR__ . '/../../resources/views/pages/' . $slug . '.php';
}

public function submitContact() {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Here you can add logic to save the contact message or send an email
header('Location: /contact-us?success=1');
}
}
}