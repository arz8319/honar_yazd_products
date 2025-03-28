<?php
$locale = $_SESSION['locale'] ?? 'fa';
$title = $locale === 'fa' ? 'نظرسنجی‌ها' : 'Polls';
ob_start();
?>
<h1 class="text-2xl font-bold"><?php echo $locale === 'fa' ? 'نظرسنجی‌ها' : 'Polls'; ?></h1>
<?php if (isset($_GET['error']) && $_GET['error'] === 'already_voted'): ?>
<p class="text-red-600 mb-4"><?php echo $locale === 'fa' ? 'شما قبلاً در این نظرسنجی رأی داده‌اید.' : 'You have already voted in this poll.'; ?></p>
<?php endif; ?>
<div class="mt-4">
<?php foreach ($polls as $poll): ?>
<div class="bg-white p-4 rounded shadow mb-4">
<h2 class="text-lg font-bold"><?php echo $poll['question']; ?></h2>
<form action="/polls/vote" method="POST">
<input type="hidden" name="poll_id" value="<?php echo $poll['id']; ?>">
<?php foreach ($poll['options'] as $option): ?>
<div class="mt-2">
<label>
<input type="radio" name="option_id" value="<?php echo $option['id']; ?>" required>
<?php echo $option['option_text']; ?> (<?php echo $option['votes']; ?> <?php echo $locale === 'fa' ? 'رأی' : 'votes'; ?>)
</label>
</div>
<?php endforeach; ?>
<button type="submit" class="bg-blue-600 text-white p-2 rounded mt-4"><?php echo $locale === 'fa' ? 'رأی دادن' : 'Vote'; ?></button>
</form>
</div>
<?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>