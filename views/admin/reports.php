<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - گزارش‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h1>گزارش‌ها</h1>
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
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">از تاریخ</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $start_date; ?>">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">تا تاریخ</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo $end_date; ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mt-4">فیلتر</button>
                </div>
            </div>
        </form>
        <h2>گزارش فروش</h2>
        <canvas id="salesChart" height="100"></canvas>
        <h2 class="mt-4">محصولات پرفروش</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>محصول</th>
                    <th>تعداد فروش</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($top_products as $product): ?>
                    <tr>
                        <td><?php echo $product['title']; ?></td>
                        <td><?php echo $product['total_sold']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo "'" . implode("','", array_column($sales_report, 'sale_date')) . "'"; ?>],
                datasets: [{
                    label: 'فروش (تومان)',
                    data: [<?php echo implode(',', array_column($sales_report, 'total_sales')); ?>],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }, {
                    label: 'تعداد سفارش‌ها',
                    data: [<?php echo implode(',', array_column($sales_report, 'order_count')); ?>],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>