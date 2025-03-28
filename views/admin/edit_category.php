<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - ویرایش دسته‌بندی</title>
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
        <h1>ویرایش دسته‌بندی</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">نام دسته‌بندی</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $category['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">دسته‌بندی والد</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">بدون والد</option>
                    <?php foreach ($categories as $cat): ?>
                        <?php if ($cat['id'] != $category['id']): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo $category['parent_id'] == $cat['id'] ? 'selected' : ''; ?>><?php echo $cat['name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
</body>
</html>