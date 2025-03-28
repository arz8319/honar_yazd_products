<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'ایجاد محصول جدید' : 'Create New Product';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ایجاد محصول جدید' : 'Create New Product'; ?></h1>
<form action="/admin/products/create" method="POST">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'نام' : 'Name'; ?></label>
<input type="text" name="name" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'توضیحات' : 'Description'; ?></label>
<textarea name="description" class="border p-2 w-full"></textarea>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'قیمت' : 'Price'; ?></label>
<input type="number" name="price" step="0.01" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'موجودی' : 'Stock'; ?></label>
<input type="number" name="stock" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'دسته‌بندی' : 'Category'; ?></label>
<select name="category_id" class="border p-2 w-full">
<?php foreach ($categories as $category): ?>
<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
<?php endforeach; ?>
</select>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'ایجاد' : 'Create'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>