<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - مدیریت نظر</title>
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
        <h1>مدیریت نظر #<?php echo $review['id']; ?></h1>
        <div class="card">
            <div class="card-body">
                <p><strong>کاربر:</strong> <?php echo $review['user_name']; ?></p>
                <p><strong>محصول:</strong> <?php echo $review['product_title']; ?></p>
                <p><strong>امتیاز:</strong> <?php echo $review['rating']; ?>/5</p>
                <p><strong>نظر:</strong> <?php echo $review['comment'] ?: '-'; ?></p>
                <p><strong>وضعیت:</strong> <?php echo $review['status'] === 'pending' ? 'در انتظار' : ($review['status'] === 'approved' ? 'تأییدشده' : ($review['status'] === 'rejected' ? 'ردشده' : $review['status'])); ?></p>
                <p><strong>تاریخ:</strong> <?php echo $review['created_at']; ?></p>
                <form method="POST" class="mb-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">تغییر وضعیت</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" <?php echo $review['status'] === 'pending' ? 'selected' : ''; ?>>در انتظار</option>
                            <option value="approved" <?php echo $review['status'] === 'approved' ? 'selected' : ''; ?>>تأییدشده</option>
                            <option value="rejected" <?php echo $review['status'] === 'rejected' ? 'selected' : ''; ?>>ردشده</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </form>
                <h3>پاسخ‌ها</h3>
                <?php if ($replies): ?>
                    <ul class="list-group mb-3">
                        <?php foreach ($replies as $reply): ?>
                            <li class="list-group-item">
                                <strong><?php echo $reply['user_name']; ?>:</strong> <?php echo $reply['reply']; ?>
                                <small class="text-muted"><?php echo $reply['created_at']; ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>هنوز پاسخی ثبت نشده است.</p>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="reply" class="form-label">پاسخ جدید</label>
                        <textarea name="reply" id="reply" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پاسخ</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>