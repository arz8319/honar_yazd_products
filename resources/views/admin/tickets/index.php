<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'مدیریت تیکت‌ها' : 'Manage Tickets';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'مدیریت تیکت‌ها' : 'Manage Tickets'; ?></h1>
<div class="mt-4">
<?php foreach ($tickets as $ticket): ?>
<div class="bg-white p-4 rounded shadow mb-4 flex justify-between">
<div>
<p><?php echo $locale === 'fa' ? 'کاربر: ' : 'User: '; ?><?php echo $ticket['user_name']; ?></p>
<p><?php echo $locale === 'fa' ? 'موضوع: ' : 'Subject: '; ?><?php echo $ticket['subject']; ?></p>
<p><?php echo $locale === 'fa' ? 'وضعیت: ' : 'Status: '; ?><?php echo $ticket['status']; ?></p>
</div>
<div>
<a href="/admin/tickets/<?php echo $ticket['id']; ?>" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'مشاهده' : 'View'; ?></a>
<a href="/admin/tickets/close/<?php echo $ticket['id']; ?>" class="bg-red-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'بستن' : 'Close'; ?></a>
</div>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>