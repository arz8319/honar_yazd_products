<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'درباره ما' : 'About Us';
ob_start();
?>
<div class="bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'درباره ما' : 'About Us'; ?></h1>
<p><?php echo $page['content']; ?></p>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>