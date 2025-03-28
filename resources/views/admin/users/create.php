<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'ایجاد کاربر جدید' : 'Create New User';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ایجاد کاربر جدید' : 'Create New User'; ?></h1>
<form action="/admin/users/create" method="POST">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'نام' : 'Name'; ?></label>
<input type="text" name="name" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'ایمیل' : 'Email'; ?></label>
<input type="email" name="email" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'رمز عبور' : 'Password'; ?></label>
<input type="password" name="password" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'نقش' : 'Role'; ?></label>
<select name="role_id" class="border p-2 w-full">
<option value="1"><?php echo $locale === 'fa' ? 'ادمین' : 'Admin'; ?></option>
<option value="2"><?php echo $locale === 'fa' ? 'کاربر' : 'User'; ?></option>
</select>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'ایجاد' : 'Create'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>