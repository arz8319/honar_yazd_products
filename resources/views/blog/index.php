<?php
require_once 'app/helpers.php';
$locale = $_SESSION['locale'] ?? 'fa';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo __('blog_posts'); ?></h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
<?php foreach ($posts as $post): ?>
<div class="bg-white p-4 rounded shadow">
<h2 class="text-lg font-bold"><?php echo $post['title']; ?></h2>
<p><?php echo substr($post['content'], 0, 100); ?>...</p>
<a href="/blog/<?php echo $post['id']; ?>" class="text-blue-600"><?php echo __('read_more'); ?></a>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>