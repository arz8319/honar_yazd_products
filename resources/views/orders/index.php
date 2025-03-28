<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'سفارش‌ها' : 'Orders'; ?></h1>
<?php if (isset($_GET['success']) && $_GET['success'] === 'payment_completed'): ?>
    <p class="text-green-600 mb-4"><?php echo $locale === 'fa' ? 'پرداخت با موفقیت انجام شد.' : 'Payment completed successfully.'; ?></p>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
    <p class="text-red-600 mb-4">
        <?php
        if ($_GET['error'] === 'payment_failed') {
            echo $locale === 'fa' ? 'پرداخت ناموفق بود.' : 'Payment failed.';
        } elseif ($_GET['error'] === 'payment_cancelled') {
            echo $locale === 'fa' ? 'پرداخت لغو شد.' : 'Payment cancelled.';
        }
        ?>
    </p>
<?php endif; ?>
<div class="mt-4">
    <?php foreach ($orders as $order): ?>
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><?php echo $locale === 'fa' ? 'شناسه سفارش: ' : 'Order ID: '; ?><?php echo $order['id']; ?></p>
            <p><?php echo $locale === 'fa' ? 'مجموع: ' : 'Total: '; ?><?php echo $order['total']; ?> <?php echo $locale === 'fa' ? 'تومان' : 'USD'; ?></p>
            <p><?php echo $locale === 'fa' ? 'وضعیت: ' : 'Status: '; ?><?php echo $order['status']; ?></p>
            <?php if ($order['status'] === 'pending'): ?>
                <a href="<?php echo $baseUrl; ?>/payment/initiate/<?php echo $order['id']; ?>" class="bg-blue-600 text-white p-2 rounded"><?php echo $locale === 'fa' ? 'پرداخت' : 'Pay Now'; ?></a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>