<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - مشاهده سفارش</title>
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
        <h1>جزئیات سفارش #<?php echo $order['id']; ?></h1>
        <div class="card">
            <div class="card-body">
                <p><strong>کاربر:</strong> <?php echo $order['user_name']; ?></p>
                <p><strong>مجموع قیمت:</strong> <?php echo $order['total_price']; ?> تومان</p>
                <p><strong>وضعیت:</strong> <?php echo $order['status'] === 'pending' ? 'در انتظار' : ($order['status'] === 'processing' ? 'در حال پردازش' : ($order['status'] === 'shipped' ? 'ارسال‌شده' : ($order['status'] === 'delivered' ? 'تحویل‌شده' : $order['status']))); ?></p>
                <p><strong>تاریخ ثبت:</strong> <?php echo $order['created_at']; ?></p>
                <form method="POST">
                    <div class="mb-3">
                        <label for="status" class="form-label">تغییر وضعیت</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>در انتظار</option>
                            <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>در حال پردازش</option>
                            <option value="shipped" <?php echo $order['status'] === 'shipped' ? 'selected' : ''; ?>>ارسال‌شده</option>
                            <option value="delivered" <?php echo $order['status'] === 'delivered' ? 'selected' : ''; ?>>تحویل‌شده</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </form>
            </div>
        </div>
        <h2 class="mt-4">محصولات سفارش</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>محصول</th>
                    <th>تعداد</th>
                    <th>قیمت واحد</th>
                    <th>جمع</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['product_title']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['price']; ?> تومان</td>
                        <td><?php echo $item['quantity'] * $item['price']; ?> تومان</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>