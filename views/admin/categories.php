<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - دسته‌بندی‌ها</title>
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
        .nested { margin-right: 20px; }
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
        <h1>مدیریت دسته‌بندی‌ها</h1>
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
        <a href="/honar_yazd_products/admin/add-category" class="btn btn-primary mb-3">اضافه کردن دسته‌بندی جدید</a>
        <table class="table" id="categoriesTable">
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>نام</th>
                    <th>دسته‌بندی والد</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function displayCategories($categories, $level = 0) {
                    foreach ($categories as $category) {
                        echo '<tr>';
                        echo '<td>' . $category['id'] . '</td>';
                        echo '<td>' . str_repeat('—', $level) . ' ' . $category['name'] . '</td>';
                        echo '<td>' . ($category['parent_id'] ? $category['parent_id'] : '-') . '</td>';
                        echo '<td>';
                        echo '<a href="/honar_yazd_products/admin/edit-category/' . $category['id'] . '" class="btn btn-sm btn-warning">ویرایش</a> ';
                        echo '<a href="/honar_yazd_products/admin/delete-category/' . $category['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'آیا مطمئن هستید؟\')">حذف</a>';
                        echo '</td>';
                        echo '</tr>';
                        if (!empty($category['children'])) {
                            displayCategories($category['children'], $level + 1);
                        }
                    }
                }
                displayCategories($categories);
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json'
                }
            });
        });
    </script>
</body>
</html>