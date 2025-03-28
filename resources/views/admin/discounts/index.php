<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'مدیریت تخفیف‌ها' : 'Manage Discounts';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'مدیریت تخفیف‌ها' : 'Manage Discounts'; ?></h1>
<div class="mt-4">
<a href="/admin/discounts/create" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ایجاد تخفیف جدید' : 'Create New Discount'; ?></a>
</div>
<div class="mt-4">
<?php foreach ($discounts as $discount): ?>
<div class="bg-white p-4 rounded shadow mb-4 flex justify-between">
<div>
<p><?php echo $locale === 'fa' ? 'محصول: ' : 'Product: '; ?><?php echo $discount['product_name']; ?></p>
<p><?php echo $locale === 'fa' ? 'درصد تخفیف: ' : 'Discount Percentage: '; ?><?php echo $discount['percentage']; ?>%</p>
<p><?php echo $locale === 'fa' ? 'تاریخ شروع: ' : 'Start Date: '; ?><?php echo $discount['start_date']; ?></p>
<p><?php echo $locale === 'fa' ? 'تاریخ پایان: ' : 'End Date: '; ?><?php echo $discount['end_date']; ?></p>
</div>
<div>
<a href="/admin/discounts/delete/<?php echo $discount['id']; ?>" class="bg-red-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'حذف' : 'Delete'; ?></a>
</div>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>