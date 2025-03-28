<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - داشبورد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <h1>داشبورد</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">تعداد محصولات</h5>
                        <p class="card-text"><?php echo $stats['total_products']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">تعداد دسته‌بندی‌ها</h5>
                        <p class="card-text"><?php echo $stats['total_categories']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">تعداد سفارش‌ها</h5>
                        <p class="card-text"><?php echo $stats['total_orders']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">نظرات در انتظار</h5>
                        <p class="card-text"><?php echo $stats['total_reviews']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-4">آخرین فعالیت‌ها</h2>
        <table class="table" id="logsTable">
            <thead>
                <tr>
                    <th>کاربر</th>
                    <th>فعالیت</th>
                    <th>جزئیات</th>
                    <th>تاریخ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats['recent_logs'] as $log): ?>
                    <tr>
                        <td><?php echo $log['user_id']; ?></td>
                        <td><?php echo $log['action']; ?></td>
                        <td><?php echo $log['details']; ?></td>
                        <td><?php echo $log['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#logsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json'
                }
            });
        });
    </script>
</body>
</html>