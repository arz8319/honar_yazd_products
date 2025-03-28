<?php
$locale = $_SESSION['locale'] ?? 'fa';
?>
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6"><?php echo $locale === 'fa' ? 'خوش آمدید به هنر یزد' : 'Welcome to Honar Yazd'; ?></h1>
    <h2 class="text-2xl font-semibold mb-4"><?php echo $locale === 'fa' ? 'محصولات پیشنهادی' : 'Featured Products'; ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <?php foreach ($products as $product): ?>
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-bold"><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="text-gray-600"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="text-green-600 font-bold mt-2"><?php echo number_format($product['price']); ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></p>
                <a href="/product/<?php echo $product['id']; ?>" class="text-blue-600 mt-2 inline-block"><?php echo $locale === 'fa' ? 'مشاهده' : 'View'; ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>