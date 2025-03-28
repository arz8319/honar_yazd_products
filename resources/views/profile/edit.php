<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'ویرایش پروفایل' : 'Edit Profile';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ویرایش پروفایل' : 'Edit Profile'; ?></h1>
<form action="/profile/edit" method="POST">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'نام' : 'Name'; ?></label>
<input type="text" name="name" value="<?php echo $user['name']; ?>" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'ایمیل' : 'Email'; ?></label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'رمز عبور جدید (اختیاری)' : 'New Password (Optional)'; ?></label>
<input type="password" name="password" class="border p-2 w-full">
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'به‌روزرسانی' : 'Update'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>