# Changelog

## [1.0.0] - 2025-03-20
### Added
- Initial project setup with user authentication
- Product listing with search and filter
- Shopping cart and order management
- Discount system
- Payment integration with Zarinpal
- Notification system
- Support tickets
- Admin dashboard for managing users, products, tickets, and discounts
- Blog and polls
- Multi-language support (Farsi, English, Arabic)
- SEO optimization
- Unit tests for products, discounts, and payments

### Fixed
- Validation for ticket creation and replies
- Optimized database queries with indexes
- Improved error handling in controllers

# CHANGELOG

## 2025-03-28
- فایل: Database.php
  - تغییر: حذف FOREIGN KEYها برای رفع خطای syntax error
  - تغییر: اضافه کردن ستون featured به جدول products
- فایل: seed_translations.php
  - تغییر: پر کردن جدول translations با داده‌های زبان‌های fa, en, ar
- فایل: update_products.php
  - تغییر: آپدیت ستون featured برای محصولات Laptop و

## 2025-03-28
- فایل: app/Controllers/HomeController.php
  - تغییر: اصلاح مسیر فایل index.php و اضافه کردن سیستم ترجمه