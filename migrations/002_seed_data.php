<?php
class SeedDataMigration extends Migration {
    public function up() {
        // اضافه کردن نقش‌های پیش‌فرض
        $roleCount = $this->db->query("SELECT COUNT(*) FROM roles")->fetchColumn();
        if ($roleCount == 0) {
            $this->db->exec("INSERT INTO roles (id, name) VALUES (1, 'user')");
            $this->db->exec("INSERT INTO roles (id, name) VALUES (2, 'admin')");
        }

        // اضافه کردن تنظیمات پیش‌فرض
        $settingsCount = $this->db->query("SELECT COUNT(*) FROM settings")->fetchColumn();
        if ($settingsCount == 0) {
            $this->db->exec("INSERT INTO settings (key, value) VALUES ('site_name', 'هنر یزد')");
            $this->db->exec("INSERT INTO settings (key, value) VALUES ('site_logo', '')");
            $this->db->exec("INSERT INTO settings (key, value) VALUES ('admin_email', '')");
        }

        // اضافه کردن محصولات
        $productCount = $this->db->query("SELECT COUNT(*) FROM products")->fetchColumn();
        if ($productCount == 0) {
            $stmt = $this->db->prepare("INSERT INTO products (name, price, description, image, created_at, featured) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute(['Laptop', 1000.00, 'A high-performance laptop', 'laptop.jpg', date('Y-m-d H:i:s'), 1]);
            $stmt->execute(['T-Shirt', 20.00, 'A comfortable cotton t-shirt', 'tshirt.jpg', date('Y-m-d H:i:s'), 1]);
        }

        // اضافه کردن ترجمه‌ها
        $translations = [
            // فارسی
            ['lang' => 'fa', 'key' => 'meta_description', 'value' => 'فروشگاه آنلاین هنر یزد'],
            ['lang' => 'fa', 'key' => 'meta_keywords', 'value' => 'هنر یزد، فروشگاه، محصولات هنری'],
            ['lang' => 'fa', 'key' => 'meta_author', 'value' => 'تیم هنر یزد'],
            ['lang' => 'fa', 'key' => 'title_default', 'value' => 'هنر یزد'],
            ['lang' => 'fa', 'key' => 'brand_name', 'value' => 'هنر یزد'],
            ['lang' => 'fa', 'key' => 'products', 'value' => 'محصولات'],
            ['lang' => 'fa', 'key' => 'cart', 'value' => 'سبد خرید'],
            ['lang' => 'fa', 'key' => 'orders', 'value' => 'سفارش‌ها'],
            ['lang' => 'fa', 'key' => 'blog', 'value' => 'وبلاگ'],
            ['lang' => 'fa', 'key' => 'polls', 'value' => 'نظرسنجی‌ها'],
            ['lang' => 'fa', 'key' => 'tickets', 'value' => 'تیکت‌ها'],
            ['lang' => 'fa', 'key' => 'notifications', 'value' => 'اعلان‌ها'],
            ['lang' => 'fa', 'key' => 'profile', 'value' => 'پروفایل'],
            ['lang' => 'fa', 'key' => 'logout', 'value' => 'خروج'],
            ['lang' => 'fa', 'key' => 'login', 'value' => 'ورود'],
            ['lang' => 'fa', 'key' => 'register', 'value' => 'ثبت‌نام'],
            ['lang' => 'fa', 'key' => 'footer_copyright', 'value' => '© 2025 هنر یزد. تمامی حقوق محفوظ است.'],
            ['lang' => 'fa', 'key' => 'admin_panel', 'value' => 'پنل مدیریت'],
            ['lang' => 'fa', 'key' => 'dashboard', 'value' => 'داشبورد'],
            ['lang' => 'fa', 'key' => 'categories', 'value' => 'دسته‌بندی‌ها'],
            ['lang' => 'fa', 'key' => 'reviews', 'value' => 'نظرات'],
            ['lang' => 'fa', 'key' => 'users', 'value' => 'کاربران'],
            ['lang' => 'fa', 'key' => 'discounts', 'value' => 'تخفیف‌ها'],
            ['lang' => 'fa', 'key' => 'reports', 'value' => 'گزارش‌ها'],
            ['lang' => 'fa', 'key' => 'settings', 'value' => 'تنظیمات'],
            ['lang' => 'fa', 'key' => 'lang_fa', 'value' => 'فارسی'],
            ['lang' => 'fa', 'key' => 'lang_en', 'value' => 'English'],
            ['lang' => 'fa', 'key' => 'lang_ar', 'value' => 'العربية'],
            ['lang' => 'fa', 'key' => 'error_500_title', 'value' => '500 - خطای سرور'],
            ['lang' => 'fa', 'key' => 'error_500_message', 'value' => 'متأسفیم، مشکلی در سرور رخ داده است.'],
            ['lang' => 'fa', 'key' => 'error_404_title', 'value' => '404 - صفحه پیدا نشد'],
            ['lang' => 'fa', 'key' => 'error_404_message', 'value' => 'صفحه‌ای که به دنبال آن هستید وجود ندارد.'],
            ['lang' => 'fa', 'key' => 'back_to_dashboard', 'value' => 'بازگشت به داشبورد'],
            ['lang' => 'fa', 'key' => 'welcome_to', 'value' => 'خوش آمدید به'],
            ['lang' => 'fa', 'key' => 'featured_products', 'value' => 'محصولات ویژه'],
            ['lang' => 'fa', 'key' => 'no_products_found', 'value' => 'محصولی یافت نشد'],
            ['lang' => 'fa', 'key' => 'view', 'value' => 'مشاهده'],

            // انگلیسی
            ['lang' => 'en', 'key' => 'meta_description', 'value' => 'Honar Yazd Online Store'],
            ['lang' => 'en', 'key' => 'meta_keywords', 'value' => 'Honar Yazd, store, art products'],
            ['lang' => 'en', 'key' => 'meta_author', 'value' => 'Honar Yazd Team'],
            ['lang' => 'en', 'key' => 'title_default', 'value' => 'Honar Yazd'],
            ['lang' => 'en', 'key' => 'brand_name', 'value' => 'Honar Yazd'],
            ['lang' => 'en', 'key' => 'products', 'value' => 'Products'],
            ['lang' => 'en', 'key' => 'cart', 'value' => 'Cart'],
            ['lang' => 'en', 'key' => 'orders', 'value' => 'Orders'],
            ['lang' => 'en', 'key' => 'blog', 'value' => 'Blog'],
            ['lang' => 'en', 'key' => 'polls', 'value' => 'Polls'],
            ['lang' => 'en', 'key' => 'tickets', 'value' => 'Tickets'],
            ['lang' => 'en', 'key' => 'notifications', 'value' => 'Notifications'],
            ['lang' => 'en', 'key' => 'profile', 'value' => 'Profile'],
            ['lang' => 'en', 'key' => 'logout', 'value' => 'Logout'],
            ['lang' => 'en', 'key' => 'login', 'value' => 'Login'],
            ['lang' => 'en', 'key' => 'register', 'value' => 'Register'],
            ['lang' => 'en', 'key' => 'footer_copyright', 'value' => '© 2025 Honar Yazd. All rights reserved.'],
            ['lang' => 'en', 'key' => 'admin_panel', 'value' => 'Admin Panel'],
            ['lang' => 'en', 'key' => 'dashboard', 'value' => 'Dashboard'],
            ['lang' => 'en', 'key' => 'categories', 'value' => 'Categories'],
            ['lang' => 'en', 'key' => 'reviews', 'value' => 'Reviews'],
            ['lang' => 'en', 'key' => 'users', 'value' => 'Users'],
            ['lang' => 'en', 'key' => 'discounts', 'value' => 'Discounts'],
            ['lang' => 'en', 'key' => 'reports', 'value' => 'Reports'],
            ['lang' => 'en', 'key' => 'settings', 'value' => 'Settings'],
            ['lang' => 'en', 'key' => 'lang_fa', 'value' => 'فارسی'],
            ['lang' => 'en', 'key' => 'lang_en', 'value' => 'English'],
            ['lang' => 'en', 'key' => 'lang_ar', 'value' => 'العربية'],
            ['lang' => 'en', 'key' => 'error_500_title', 'value' => '500 - Server Error'],
            ['lang' => 'en', 'key' => 'error_500_message', 'value' => 'Sorry, something went wrong on the server.'],
            ['lang' => 'en', 'key' => 'error_404_title', 'value' => '404 - Page Not Found'],
            ['lang' => 'en', 'key' => 'error_404_message', 'value' => 'The page you are looking for does not exist.'],
            ['lang' => 'en', 'key' => 'back_to_dashboard', 'value' => 'Back to Dashboard'],
            ['lang' => 'en', 'key' => 'welcome_to', 'value' => 'Welcome to'],
            ['lang' => 'en', 'key' => 'featured_products', 'value' => 'Featured Products'],
            ['lang' => 'en', 'key' => 'no_products_found', 'value' => 'No products found'],
            ['lang' => 'en', 'key' => 'view', 'value' => 'View'],

            // عربی
            ['lang' => 'ar', 'key' => 'meta_description', 'value' => 'متجر هنر يزد الإلكتروني'],
            ['lang' => 'ar', 'key' => 'meta_keywords', 'value' => 'هنر يزد، متجر، منتجات فنية'],
            ['lang' => 'ar', 'key' => 'meta_author', 'value' => 'فريق هنر يزد'],
            ['lang' => 'ar', 'key' => 'title_default', 'value' => 'هنر يزد'],
            ['lang' => 'ar', 'key' => 'brand_name', 'value' => 'هنر يزد'],
            ['lang' => 'ar', 'key' => 'products', 'value' => 'المنتجات'],
            ['lang' => 'ar', 'key' => 'cart', 'value' => 'سلة التسوق'],
            ['lang' => 'ar', 'key' => 'orders', 'value' => 'الطلبات'],
            ['lang' => 'ar', 'key' => 'blog', 'value' => 'المدونة'],
            ['lang' => 'ar', 'key' => 'polls', 'value' => 'استطلاعات الرأي'],
            ['lang' => 'ar', 'key' => 'tickets', 'value' => 'التذاكر'],
            ['lang' => 'ar', 'key' => 'notifications', 'value' => 'الإشعارات'],
            ['lang' => 'ar', 'key' => 'profile', 'value' => 'الملف الشخصي'],
            ['lang' => 'ar', 'key' => 'logout', 'value' => 'تسجيل الخروج'],
            ['lang' => 'ar', 'key' => 'login', 'value' => 'تسجيل الدخول'],
            ['lang' => 'ar', 'key' => 'register', 'value' => 'التسجيل'],
            ['lang' => 'ar', 'key' => 'footer_copyright', 'value' => '© 2025 هنر يزد. جميع الحقوق محفوظة.'],
            ['lang' => 'ar', 'key' => 'admin_panel', 'value' => 'لوحة الإدارة'],
            ['lang' => 'ar', 'key' => 'dashboard', 'value' => 'لوحة التحكم'],
            ['lang' => 'ar', 'key' => 'categories', 'value' => 'الفئات'],
            ['lang' => 'ar', 'key' => 'reviews', 'value' => 'المراجعات'],
            ['lang' => 'ar', 'key' => 'users', 'value' => 'المستخدمون'],
            ['lang' => 'ar', 'key' => 'discounts', 'value' => 'الخصومات'],
            ['lang' => 'ar', 'key' => 'reports', 'value' => 'التقارير'],
            ['lang' => 'ar', 'key' => 'settings', 'value' => 'الإعدادات'],
            ['lang' => 'ar', 'key' => 'lang_fa', 'value' => 'فارسی'],
            ['lang' => 'ar', 'key' => 'lang_en', 'value' => 'English'],
            ['lang' => 'ar', 'key' => 'lang_ar', 'value' => 'العربية'],
            ['lang' => 'ar', 'key' => 'error_500_title', 'value' => '500 - خطأ في الخادم'],
            ['lang' => 'ar', 'key' => 'error_500_message', 'value' => 'عذراً، حدث خطأ في الخادم.'],
            ['lang' => 'ar', 'key' => 'error_404_title', 'value' => '404 - الصفحة غير موجودة'],
            ['lang' => 'ar', 'key' => 'error_404_message', 'value' => 'الصفحة التي تبحث عنها غير موجودة.'],
            ['lang' => 'ar', 'key' => 'back_to_dashboard', 'value' => 'العودة إلى لوحة التحكم'],
            ['lang' => 'ar', 'key' => 'welcome_to', 'value' => 'مرحباً بكم في'],
            ['lang' => 'ar', 'key' => 'featured_products', 'value' => 'المنتجات المميزة'],
            ['lang' => 'ar', 'key' => 'no_products_found', 'value' => 'لم يتم العثور على منتجات'],
            ['lang' => 'ar', 'key' => 'view', 'value' => 'عرض'],
        ];

        foreach ($translations as $translation) {
            $stmt = $this->db->prepare("INSERT OR IGNORE INTO translations (lang, key, value) VALUES (?, ?, ?)");
            $stmt->execute([$translation['lang'], $translation['key'], $translation['value']]);
        }
    }
}