<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? $product['title'] : $product['title'];
$meta_description = $locale === 'fa' ? "خرید {$product['title']} با قیمت {$product['price']} تومان - هنر یزد" : "Buy {$product['title']} for {$product['price']} USD - Honar Yazd";
ob_start();
?>
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold"><?php echo $product['title']; ?></h1>
    <p class="mt-2"><?php echo $product['description']; ?></p>
    <p class="mt-2">
        <?php if (isset($product['discount_percentage'])): ?>
            <span class="line-through text-gray-500"><?php echo $product['original_price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></span>
            <span class="text-green-600"><?php echo $product['price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></span>
            <span class="text-red-600"><?php echo $product['discount_percentage']; ?>% <?php echo $locale === 'fa' ? 'تخفیف' : 'off'; ?></span>
        <?php else: ?>
            <?php echo $product['price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?>
        <?php endif; ?>
    </p>
    <form action="<?php echo $baseUrl; ?>/cart/add" method="POST" class="mt-4">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button type="submit" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'افزودن به سبد خرید' : 'Add to Cart'; ?></button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>