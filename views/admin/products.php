<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - محصولات</title>
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
        <h1>مدیریت محصولات</h1>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <a href="/honar_yazd_products/admin/add-product" class="btn btn-primary mb-3">اضافه کردن محصول جدید</a>
        <a href="/honar_yazd_products/admin/update-prices" class="btn btn-secondary mb-3">تغییر قیمت‌ها</a>
        <table class="table">
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>قیمت</th>
                    <th>دسته‌بندی</th>
                    <th>موجودی</th>
                    <th>عکس‌ها</th>
                    <th>فیلم‌ها</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['title']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td>
                            <?php
                            $category = array_filter($categories, fn($cat) => $cat['id'] == $product['category_id']);
                            echo $category ? reset($category)['name'] : '-';
                            ?>
                        </td>
                        <td><?php echo isset($product['stock']) ? $product['stock'] : 0; ?></td>
                        <td>
                            <?php
                            $images = json_decode($product['images'], true) ?: [];
                            foreach ($images as $image) {
                                echo '<img src="/honar_yazd_products/uploads/' . $image . '" width="50" class="me-1">';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $videos = json_decode($product['videos'], true) ?: [];
                            foreach ($videos as $video) {
                                echo '<video src="/honar_yazd_products/uploads/' . $video . '" width="50" controls class="me-1"></video>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="/honar_yazd_products/admin/edit-product/<?php echo $product['id']; ?>" class="btn btn-sm btn-warning">ویرایش</a>
                            <a href="/honar_yazd_products/admin/delete-product/<?php echo $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>