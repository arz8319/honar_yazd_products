<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'مدیریت کاربران' : 'Manage Users';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'مدیریت کاربران' : 'Manage Users'; ?></h1>
<div class="mt-4">
<a href="/admin/users/create" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ایجاد کاربر جدید' : 'Create New User'; ?></a>
</div>
<div class="mt-4">
<?php foreach ($users as $user): ?>
<div class="bg-white p-4 rounded shadow mb-4">
<p><?php echo $locale === 'fa' ? 'نام: ' : 'Name: '; ?><?php echo $user['name']; ?></p>
<p><?php echo $locale === 'fa' ? 'ایمیل: ' : 'Email: '; ?><?php echo $user['email']; ?></p>
<p><?php echo $locale === 'fa' ? 'نقش: ' : 'Role: '; ?><?php echo $user['role_id'] == 1 ? ($locale === 'fa' ? 'ادمین' : 'Admin') : ($locale === 'fa' ? 'کاربر' : 'User'); ?></p>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>