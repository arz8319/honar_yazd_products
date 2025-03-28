<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'جزئیات تیکت' : 'Ticket Details';
ob_start();
?>
<div class="bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'جزئیات تیکت' : 'Ticket Details'; ?></h1>
<p><?php echo $locale === 'fa' ? 'موضوع: ' : 'Subject: '; ?><?php echo $ticket['subject']; ?></p>
<p><?php echo $locale === 'fa' ? 'توضیحات: ' : 'Description: '; ?><?php echo $ticket['description']; ?></p>
<p><?php echo $locale === 'fa' ? 'وضعیت: ' : 'Status: '; ?><?php echo $ticket['status']; ?></p>
<h2 class="text-xl font-bold mt-4"><?php echo $locale === 'fa' ? 'پاسخ‌ها' : 'Replies'; ?></h2>
<div class="mt-4">
<?php foreach ($replies as $reply): ?>
<div class="bg-gray-100 p-4 rounded mb-2">
<p><strong><?php echo $reply['user_name']; ?>:</strong> <?php echo $reply['reply']; ?></p>
<p class="text-sm text-gray-600"><?php echo $reply['created_at']; ?></p>
</div>
<?php endforeach; ?>
</div>
<form action="/admin/tickets/reply" method="POST" class="mt-4">
<input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
<div class="mb-4">
<label class="block mb-1"><?php echo $locale === 'fa' ? 'پاسخ شما' : 'Your Reply'; ?></label>
<textarea name="reply" class="border p-2 w-full" required></textarea>
</div>
<button type="submit" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ارسال پاسخ' : 'Submit Reply'; ?></button>
</form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>