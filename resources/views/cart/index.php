<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'سبد خرید' : 'Cart'; ?></h1>
<div class="mt-4">
    <?php if (empty($products)): ?>
        <p><?php echo $locale === 'fa' ? 'سبد خرید شما خالی است.' : 'Your cart is empty.'; ?></p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <div class="bg-white p-4 rounded shadow mb-4 flex justify-between">
                <div>
                    <p><?php echo $locale === 'fa' ? 'محصول: ' : 'Product: '; ?><?php echo $product['name']; ?></p>
                    <p><?php echo $locale === 'fa' ? 'تعداد: ' : 'Quantity: '; ?><?php echo $product['quantity']; ?></p>
                    <p>
                        <?php if (isset($product['discount_percentage'])): ?>
                            <span class="line-through text-gray-500"><?php echo $product['original_price'] * $product['quantity']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></span>
                            <span class="text-green-600"><?php echo $product['price'] * $product['quantity']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></span>
                            <span class="text-red-600"><?php echo $product['discount_percentage']; ?>% <?php echo $locale === 'fa' ? 'تخفیف' : 'off'; ?></span>
                        <?php else: ?>
                            <?php echo $product['price'] * $product['quantity']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <form action="<?php echo $baseUrl; ?>/cart/remove" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="bg-red-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'حذف' : 'Remove'; ?></button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <p class="text-xl font-bold"><?php echo $locale === 'fa' ? 'مجموع: ' : 'Total: '; ?><?php echo $total; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></p>
        <a href="<?php echo $baseUrl; ?>/orders/create" class="bg-blue-600 text-white p-2 rounded mt-4 inline-block"><?php echo $locale === 'fa' ? 'ثبت سفارش' : 'Checkout'; ?></a>
    <?php endif; ?>
</div>