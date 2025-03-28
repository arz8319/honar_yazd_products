<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'مدیریت محصولات' : 'Manage Products';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'مدیریت محصولات' : 'Manage Products'; ?></h1>
<div class="mt-4">
<a href="/admin/products/create" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ایجاد محصول جدید' : 'Create New Product'; ?></a>
</div>
<div class="mt-4">
<?php foreach ($products as $product): ?>
<div class="bg-white p-4 rounded shadow mb-4 flex justify-between">
<div>
<p><?php echo $locale === 'fa' ? 'نام: ' : 'Name: '; ?><?php echo $product['name']; ?></p>
<p><?php echo $locale === 'fa' ? 'قیمت: ' : 'Price: '; ?><?php echo $product['price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></p>
<p><?php echo $locale === 'fa' ? 'موجودی: ' : 'Stock: '; ?><?php echo $product['stock']; ?></p>
</div>
<div>
<a href="/admin/products/edit/<?php echo $product['id']; ?>" class="bg-yellow-500 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ویرایش' : 'Edit'; ?></a>
</div>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>