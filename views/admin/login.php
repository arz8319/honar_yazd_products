<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود به پنل مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { direction: rtl; font-family: Arial, sans-serif; background: #f8f9fa; }
        .login-container { max-width: 400px; margin: 100px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">ورود به پنل مدیریت</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">نام کاربری:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">رمز عبور:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">ورود</button>
        </form>
    </div>
</body>
</html>