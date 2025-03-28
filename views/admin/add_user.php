<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - اضافه کردن کاربر</title>
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
        <h1>اضافه کردن کاربر</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">نام</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">نام کاربری</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">نقش</label>
                <select name="role" id="role" class="form-control">
                    <option value="customer">مشتری</option>
                    <option value="admin">ادمین</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
</body>
</html>