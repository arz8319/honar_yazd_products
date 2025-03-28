<?php
namespace App\Controllers;

use App\Models\BlogPost;
use App\Models\BlogComment;

class BlogController {
private $db;
private $blogPostModel;
private $blogCommentModel;

public function __construct($db) {
$this->db = $db;
$this->blogPostModel = new BlogPost($db);
$this->blogCommentModel = new BlogComment($db);
}

public function index() {
$posts = $this->blogPostModel->getAll();
require __DIR__ . '/../../resources/views/blog/index.php';
}

public function show($id) {
$post = $this->blogPostModel->getById($id);
$comments = $this->blogCommentModel->getByPostId($id);
require __DIR__ . '/../../resources/views/blog/show.php';
}
}