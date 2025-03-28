<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $post['title'];
ob_start();
?>
<div class="bg-white p-4 rounded shadow">
<h1 class="text-2xl font-bold"><?php echo $post['title']; ?></h1>
<p class="mt-4"><?php echo $post['content']; ?></p>
</div>
<h2 class="text-xl font-bold mt-4"><?php echo $locale === 'fa' ? 'نظرات' : 'Comments'; ?></h2>
<div class="mt-4">
<?php foreach ($comments as $comment): ?>
<div class="bg-gray-100 p-4 rounded mb-2">
<p><?php echo $comment['comment']; ?></p>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>