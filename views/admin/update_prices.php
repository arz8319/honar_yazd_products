<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - تغییر قیمت‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <a href="/honar_yazd_products/admin/logout">خروج</a>
    </div>
    <div class="content">
        <h1>تغییر قیمت‌ها</h1>
        <h3>تغییر قیمت با فایل اکسل</h3>
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label class="form-label">فایل اکسل (ستون‌ها: product_id, price):</label>
                <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls">
            </div>
            <button type="submit" class="btn btn-primary">آپلود و اعمال</button>
        </form>
        <h3>تغییر قیمت بر اساس دسته‌بندی</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">دسته‌بندی:</label>
                <select name="category_id" class="form-control">
                    <option value="">انتخاب کنید</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">درصد تغییر (مثبت برای افزایش، منفی برای کاهش):</label>
                <input type="number" name="percentage" class="form-control" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">اعمال</button>
        </form>
    </div>
</body>
</html>