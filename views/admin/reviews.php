<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - نظرات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
        <h1>مدیریت نظرات</h1>
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
        <table class="table" id="reviewsTable">
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>کاربر</th>
                    <th>محصول</th>
                    <th>امتیاز</th>
                    <th>نظر</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?php echo $review['id']; ?></td>
                        <td><?php echo $review['user_name']; ?></td>
                        <td><?php echo $review['product_title']; ?></td>
                        <td><?php echo $review['rating']; ?>/5</td>
                        <td><?php echo $review['comment'] ?: '-'; ?></td>
                        <td>
                            <?php
                            $status = $review['status'];
                            $badge = match ($status) {
                                'pending' => 'bg-warning',
                                'approved' => 'bg-success',
                                'rejected' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                            echo "<span class='badge $badge'>" . ($status === 'pending' ? 'در انتظار' : ($status === 'approved' ? 'تأییدشده' : ($status === 'rejected' ? 'ردشده' : $status))) . "</span>";
                            ?>
                        </td>
                        <td><?php echo $review['created_at']; ?></td>
                        <td>
                            <a href="/honar_yazd_products/admin/manage-review/<?php echo $review['id']; ?>" class="btn btn-sm btn-info">مدیریت</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#reviewsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json'
                }
            });
        });
    </script>
</body>
</html>