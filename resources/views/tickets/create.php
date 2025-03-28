<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'ایجاد تیکت جدید' : 'Create New Ticket';
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ایجاد تیکت جدید' : 'Create New Ticket'; ?></h1>
<?php if (isset($error)): ?>
<p class="text-red-600 mb-4"><?php echo $error; ?></p>
<?php endif; ?>
<form action="/tickets/create" method="POST">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'موضوع' : 'Subject'; ?></label>
<input type="text" name="subject" class="border p-2 w-full" required maxlength="255">
</div>
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'توضیحات' : 'Description'; ?></label>
<textarea name="description" class="border p-2 w-full" required></textarea>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'ارسال' : 'Submit'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>