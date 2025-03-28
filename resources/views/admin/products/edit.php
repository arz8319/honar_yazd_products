<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'ویرایش محصول' : 'Edit Product';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ویرایش محصول' : 'Edit Product'; ?></h1>
<form action="/admin/products/edit/<?php echo $product['id']; ?>" method="POST">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'نام' : 'Name'; ?></label>
<input type="text" name="name" value="<?php echo $product['name']; ?>" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'توضیحات' : 'Description'; ?></label>
<textarea name="description" class="border p-2 w-full"><?php echo $product['description']; ?></textarea>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'قیمت' : 'Price'; ?></label>
<input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'موجودی' : 'Stock'; ?></label>
<input type="number" name="stock" value="<?php echo $product['stock']; ?>" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'دسته‌بندی' : 'Category'; ?></label>
<select name="category_id" class="border p-2 w-full">
<?php foreach ($categories as $category): ?>
<option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
<?php endforeach; ?>
</select>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'به‌روزرسانی' : 'Update'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>