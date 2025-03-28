<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'تماس با ما' : 'Contact Us';
ob_start();
?>
<div class="bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'تماس با ما' : 'Contact Us'; ?></h1>
<p><?php echo $page['content']; ?></p>
<form action="/contact/submit" method="POST" class="mt-4">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'نام' : 'Name'; ?></label>
<input type="text" name="name" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'ایمیل' : 'Email'; ?></label>
<input type="email" name="email" class="border p-2 w-full" required>
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'پیام' : 'Message'; ?></label>
<textarea name="message" class="border p-2 w-full" required></textarea>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ارسال' : 'Submit'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>