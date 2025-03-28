<!DOCTYPE html>
<?php
require_once 'app/helpers.php';
$baseUrl = '/honar_yazd_products';
$rtlLangs = ['fa', 'ar'];
$locale = $_SESSION['locale'] ?? 'fa';
$dir = in_array($locale, $rtlLangs) ? 'rtl' : 'ltr';

// چک کردن اینکه آیا کاربر توی پنل ادمینه
$isAdmin = strpos($_SERVER['REQUEST_URI'], '/admin') !== false;
?>
<html lang="<?php echo $locale; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo __('meta_description'); ?>">
    <meta name="keywords" content="<?php echo __('meta_keywords'); ?>">
    <meta name="author" content="<?php echo __('meta_author'); ?>">
    <meta name="robots" content="index, follow">
    <title><?php echo $title ?? __('title_default'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vazir-font@28.0.0/dist/font-face.css" rel="stylesheet">
    <style>
        body {
            font-family: <?php echo in_array($locale, $rtlLangs) ? "'Vazir', sans-serif" : "'Roboto', sans-serif"; ?>;
            background-color: #f8f9fa;
        }
        <?php if ($isAdmin): ?>
        .sidebar {
            height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            width: 250px;
            background: #343a40;
            padding-top: 20px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-right: 250px;
            padding: 20px;
        }
        <?php endif; ?>
        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .footer {
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php if ($isAdmin): ?>
        <!-- منوی سایدبار برای پنل ادمین -->
        <div class="sidebar">
            <h3 class="text-center text-white"><?php echo __('admin_panel'); ?></h3>
            <a href="<?php echo $baseUrl; ?>/admin"><?php echo __('dashboard'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/products"><?php echo __('products'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/orders"><?php echo __('orders'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/categories"><?php echo __('categories'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/reviews"><?php echo __('reviews'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/users"><?php echo __('users'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/discounts"><?php echo __('discounts'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/reports"><?php echo __('reports'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/settings"><?php echo __('settings'); ?></a>
            <a href="<?php echo $baseUrl; ?>/admin/logout"><?php echo __('logout'); ?></a>
            <div class="px-4 mt-3">
                <select onchange="window.location.href='<?php echo $baseUrl; ?>/language?locale='+this.value" class="form-select">
                    <option value="fa" <?php echo $locale === 'fa' ? 'selected' : ''; ?>><?php echo __('lang_fa'); ?></option>
                    <option value="en" <?php echo $locale === 'en' ? 'selected' : ''; ?>><?php echo __('lang_en'); ?></option>
                    <option value="ar" <?php echo $locale === 'ar' ? 'selected' : ''; ?>><?php echo __('lang_ar'); ?></option>
                </select>
            </div>
        </div>
        <div class="content">
            <?php echo $content; ?>
        </div>
    <?php else: ?>
        <!-- منوی ناوبری برای کاربران عادی -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="<?php echo $baseUrl; ?>/"><?php echo __('brand_name'); ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/products"><?php echo __('products'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/cart"><?php echo __('cart'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/orders"><?php echo __('orders'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/blog"><?php echo __('blog'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/polls"><?php echo __('polls'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/tickets"><?php echo __('tickets'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/notifications"><?php echo __('notifications'); ?></a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $baseUrl; ?>/profile"><?php echo __('profile'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $baseUrl; ?>/logout"><?php echo __('logout'); ?></a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $baseUrl; ?>/auth/login"><?php echo __('login'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $baseUrl; ?>/auth/register"><?php echo __('register'); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <select onchange="window.location.href='<?php echo $baseUrl; ?>/language?locale='+this.value" class="form-select ms-2" style="width: auto;">
                                <option value="fa" <?php echo $locale === 'fa' ? 'selected' : ''; ?>><?php echo __('lang_fa'); ?></option>
                                <option value="en" <?php echo $locale === 'en' ? 'selected' : ''; ?>><?php echo __('lang_en'); ?></option>
                                <option value="ar" <?php echo $locale === 'ar' ? 'selected' : ''; ?>><?php echo __('lang_ar'); ?></option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container mt-4">
            <?php echo $content; ?>
        </main>
        <footer class="footer bg-primary text-white p-4 mt-4">
            <div class="container text-center">
                <p><?php echo __('footer_copyright'); ?></p>
            </div>
        </footer>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>