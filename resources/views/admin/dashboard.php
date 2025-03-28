<?php
require_once 'app/helpers.php';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo __('dashboard'); ?></h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold"><?php echo __('total_users'); ?></h2>
        <p><?php echo count($users); ?></p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold"><?php echo __('total_orders'); ?></h2>
        <p><?php echo count($orders); ?></p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold"><?php echo __('total_tickets'); ?></h2>
        <p><?php echo count($tickets); ?></p>
        <a href="/admin/tickets" class="text-blue-600"><?php echo __('manage_tickets'); ?></a>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold"><?php echo __('total_reports'); ?></h2>
        <p><?php echo count($reports); ?></p>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>