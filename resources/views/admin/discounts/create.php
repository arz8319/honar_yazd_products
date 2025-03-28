<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'ایجاد تخفیف جدید' : 'Create New Discount';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ایجاد تخفیف جدید' : 'Create New Discount'; ?></h1>
<form action="/admin/discounts/create" method="POST">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'محصول' : 'Product'; ?></label>
<select name="product_id" class="border p-2 w-full" required>
<?php foreach ($products as $product): ?>
<option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'درصد تخفیف' : 'Discount Percentage'; ?></label>
<input type="number" name="percentage" min="1" max="100" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'تاریخ شروع' : 'Start Date'; ?></label>
<input type="date" name="start_date" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'تاریخ پایان' : 'End Date'; ?></label>
<input type="date" name="end_date" class="border p-2 w-full" required>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'ایجاد' : 'Create'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>