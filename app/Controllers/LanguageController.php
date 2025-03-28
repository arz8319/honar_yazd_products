<?php
namespace App\Controllers;

class LanguageController {
    public function change() {
        // زبان‌های مجاز
        $allowedLocales = ['fa', 'en', 'ar'];
        
        // گرفتن زبان از پارامترهای GET، اگه وجود نداشت پیش‌فرض 'fa'
        $locale = $_GET['locale'] ?? 'fa';
        
        // چک کردن اینکه زبان انتخاب‌شده مجاز هست یا نه
        if (in_array($locale, $allowedLocales)) {
            $_SESSION['locale'] = $locale;
        } else {
            // اگه زبان غیرمجاز بود، به پیش‌فرض برگرد
            $_SESSION['locale'] = 'fa';
        }

        // ریدایرکت به صفحه قبلی یا صفحه پیش‌فرض
        $referer = $_SERVER['HTTP_REFERER'] ?? '/honar_yazd_products/';
        header("Location: $referer");
        exit;
    }
}