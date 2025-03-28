<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'پروفایل' : 'Profile';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'پروفایل شما' : 'Your Profile'; ?></h1>
<p><?php echo $locale === 'fa' ? 'نام: ' : 'Name: '; ?><?php echo $user['name']; ?></p>
<p><?php echo $locale === 'fa' ? 'ایمیل: ' : 'Email: '; ?><?php echo $user['email']; ?></p>
<p><?php echo $locale === 'fa' ? 'نقش: ' : 'Role: '; ?><?php echo $user['role_id'] == 1 ? ($locale === 'fa' ? 'ادمین' : 'Admin') : ($locale === 'fa' ? 'کاربر' : 'User'); ?></p>
<a href="/profile/edit" class="bg-blue-600 text-white p-2 rounded mt-4 inline-block"><?php echo $locale === 'fa' ? 'ویرایش پروفایل' : 'Edit Profile'; ?></a>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>