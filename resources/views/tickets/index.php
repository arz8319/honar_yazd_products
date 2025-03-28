<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'تیکت‌های پشتیبانی' : 'Support Tickets'; ?></h1>
<div class="mt-4">
    <a href="<?php echo $baseUrl; ?>/tickets/create" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'ایجاد تیکت جدید' : 'Create New Ticket'; ?></a>
</div>
<div class="mt-4">
    <?php foreach ($tickets as $ticket): ?>
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><?php echo $locale === 'fa' ? 'موضوع: ' : 'Subject: '; ?><?php echo $ticket['subject']; ?></p>
            <p><?php echo $locale === 'fa' ? 'وضعیت: ' : 'Status: '; ?><?php echo $ticket['status']; ?></p>
            <a href="<?php echo $baseUrl; ?>/tickets/<?php echo $ticket['id']; ?>" class="text-blue-600"><?php echo $locale === 'fa' ? 'مشاهده' : 'View'; ?></a>
        </div>
    <?php endforeach; ?>
</div>