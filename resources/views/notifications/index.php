<?php require_once 'app/helpers.php'; ?>
<h1 class="text-2xl font-bold"><?php echo $title; ?></h1>
<?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>
    <p class="text-green-600 mb-4"><?php echo __('notification_deleted_successfully'); ?></p>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] === 'not_found'): ?>
    <p class="text-red-600 mb-4"><?php echo __('notification_not_found'); ?></p>
<?php endif; ?>
<div class="mt-4">
    <?php if (empty($notifications)): ?>
        <p><?php echo __('no_notifications_available'); ?></p>
    <?php else: ?>
        <?php foreach ($notifications as $notification): ?>
            <div class="bg-white p-4 rounded shadow mb-4 flex justify-between">
                <div>
                    <p><?php echo $notification['message']; ?></p>
                    <p class="text-sm text-gray-600"><?php echo $notification['created_at']; ?></p>
                </div>
                <div>
                    <a href="<?php echo $baseUrl; ?>/notifications/delete/<?php echo $notification['id']; ?>" class="bg-red-600 text-white p-2 rounded"><?php echo __('delete'); ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>