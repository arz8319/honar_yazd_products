<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4"><?php echo $locale === 'fa' ? 'ثبت‌نام' : 'Register'; ?></h1>
    <?php if (isset($error)): ?>
        <p class="text-red-600 mb-4"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="<?php echo $baseUrl; ?>/auth/register" method="POST">
        <div class="mb-4">
            <label class="block mb-1"><?php echo $locale === 'fa' ? 'نام' : 'Name'; ?></label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1"><?php echo $locale === 'fa' ? 'نام کاربری' : 'Username'; ?></label>
            <input type="text" name="username" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1"><?php echo $locale === 'fa' ? 'ایمیل' : 'Email'; ?></label>
            <input type="email" name="email" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1"><?php echo $locale === 'fa' ? 'رمز عبور' : 'Password'; ?></label>
            <input type="password" name="password" class="border p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white p-2 rounded w-full"><?php echo $locale === 'fa' ? 'ثبت‌نام' : 'Register'; ?></button>
    </form>
</div>