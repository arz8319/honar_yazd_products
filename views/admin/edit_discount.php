<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - ویرایش تخفیف</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { direction: rtl; font-family: Arial, sans-serif; }
        .sidebar { height: 100vh; position: fixed; right: 0; top: 0; width: 250px; background: #343a40; padding-top: 20px; }
        .sidebar a { color: white; padding: 10px 20px; display: block; text-decoration: none; }
        .sidebar a:hover { background: #495057; }
        .content { margin-right: 250px; padding: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="text-center text-white">پنل مدیریت</h3>
        <a href="/honar_yazd_products/admin">داشبورد</a>
        <a href="/honar_yazd_products/admin/products">محصولات</a>
        <a href="/honar_yazd_products/admin/orders">سفارش‌ها</a>
        <a href="/honar_yazd_products/admin/categories">دسته‌بندی‌ها</a>
        <a href="/honar_yazd_products/admin/reviews">نظرات</a>
        <a href="/honar_yazd_products/admin/users">کاربران</a>
        <a href="/honar_yazd_products/admin/discounts">تخفیف‌ها</a>
        <a href="/honar_yazd_products/admin/reports">گزارش‌ها</a>
        <a href="/honar_yazd_products/admin/settings">تنظیمات</a>
        <a href="/honar_yazd_products/admin/logout">خروج</a>
    </div>
    <div class="content">
        <h1>ویرایش تخفیف</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="product_id" class="form-label">محصول</label>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="">انتخاب کنید (اختیاری)</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['id']; ?>" <?php echo $discount['product_id'] == $product['id'] ? 'selected' : ''; ?>><?php echo $product['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">دسته‌بندی</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">انتخاب کنید (اختیاری)</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $discount['category_id'] == $category['id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="percentage" class="form-label">درصد تخفیف</label>
                <input type="number" name="percentage" id="percentage" class="form-control" value="<?php echo $discount['percentage']; ?>" required min="0" max="100">
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">تاریخ شروع</label>
                <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($discount['start_date'])); ?>" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">تاریخ پایان</label>
                <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($discount['end_date'])); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
</body>
</html>