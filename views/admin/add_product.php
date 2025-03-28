<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت - اضافه کردن محصول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
        <h1>اضافه کردن محصول جدید</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">عنوان:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">توضیحات:</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">قیمت:</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
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
                <label class="form-label">موجودی:</label>
                <input type="number" name="stock" class="form-control" value="0">
            </div>
            <div class="mb-3">
                <label class="form-label">ویژگی‌ها (JSON):</label>
                <textarea name="attributes" class="form-control" rows="3">{"color": "red", "size": "M"}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">عکس‌ها:</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">فیلم‌ها:</label>
                <input type="file" name="videos[]" class="form-control" multiple accept="video/*">
            </div>
            <button type="submit" class="btn btn-primary">اضافه کردن</button>
        </form>
    </div>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>
</html>