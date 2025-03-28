<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = __('error_404_title');
ob_start();
?>
<div class="text-center mt-5">
    <h1 class="display-4"><?php echo __('error_404_title'); ?></h1>
    <p class="mt-4"><?php echo __('error_404_message'); ?></p>
    <a href="/honar_yazd_products/admin" class="btn btn-primary"><?php echo __('back_to_dashboard'); ?></a>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>