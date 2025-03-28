<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'محصولات' : 'Products'; ?></h1>
<form action="<?php echo $baseUrl; ?>/products" method="GET" class="mt-4 flex gap-4">
    <div>
        <label class="block mb-1"><?php echo $locale === 'fa' ? 'جستجو' : 'Search'; ?></label>
        <input type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="border p-2 w-full" placeholder="<?php echo $locale === 'fa' ? 'جستجو...' : 'Search...'; ?>">
    </div>
    <div>
        <label class="block mb-1"><?php echo $locale === 'fa' ? 'دسته‌بندی' : 'Category'; ?></label>
        <select name="category_id" class="border p-2 w-full">
            <option value=""><?php echo $locale === 'fa' ? 'همه' : 'All'; ?></option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo isset($_GET['category_id']) && $_GET['category_id'] == $category['id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'فیلتر' : 'Filter'; ?></button>
</form>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
    <?php foreach ($products as $product): ?>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold"><?php echo $product['title']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p class="mt-2">
                <?php if (isset($product['discount_percentage'])): ?>
                    <span class="line-through text-gray-500"><?php echo $product['original_price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></span>
                    <span class="text-green-600"><?php echo $product['price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></span>
                    <span class="text-red-600"><?php echo $product['discount_percentage']; ?>% <?php echo $locale === 'fa' ? 'تخفیف' : 'off'; ?></span>
                <?php else: ?>
                    <?php echo $product['price']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?>
                <?php endif; ?>
            </p>
            <a href="<?php echo $baseUrl; ?>/product/<?php echo $product['id']; ?>" class="text-blue-600 mt-2 block"><?php echo $locale === 'fa' ? 'مشاهده جزئیات' : 'View Details'; ?></a>
        </div>
    <?php endforeach; ?>
</div>