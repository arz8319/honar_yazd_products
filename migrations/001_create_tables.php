<?php
class CreateTablesMigration extends Migration {
    public function up() {
        // ایجاد جدول roles
        $this->db->exec("CREATE TABLE IF NOT EXISTS roles (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255)
        )");

        // ایجاد جدول users
        $this->db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255),
            username VARCHAR(255),
            email VARCHAR(255) UNIQUE,
            password TEXT,
            role_id INTEGER,
            created_at DATETIME,
            role TEXT DEFAULT 'user'
        )");

        // ایجاد جدول carts
        $this->db->exec("CREATE TABLE IF NOT EXISTS carts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            items TEXT
        )");

        // ایجاد جدول categories
        $this->db->exec("CREATE TABLE IF NOT EXISTS categories (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255),
            parent_id INTEGER
        )");

        // ایجاد جدول products
        $this->db->exec("CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255),
            price DECIMAL(10, 2),
            description TEXT,
            image VARCHAR(255),
            created_at DATETIME,
            featured INTEGER DEFAULT 0,
            stock INTEGER DEFAULT 0,
            category_id INTEGER,
            images TEXT DEFAULT '[]',
            videos TEXT DEFAULT '[]',
            attributes TEXT DEFAULT '[]'
        )");

        // ایجاد جدول discounts
        $this->db->exec("CREATE TABLE IF NOT EXISTS discounts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            product_id INTEGER,
            percentage DECIMAL(5, 2),
            start_date DATETIME,
            end_date DATETIME,
            category_id INTEGER
        )");

        // ایجاد جدول orders
        $this->db->exec("CREATE TABLE IF NOT EXISTS orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            total_price DECIMAL(10, 2),
            status TEXT DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // ایجاد جدول order_items
        $this->db->exec("CREATE TABLE IF NOT EXISTS order_items (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            order_id INTEGER,
            product_id INTEGER,
            quantity INTEGER,
            price DECIMAL(10, 2)
        )");

        // ایجاد جدول reviews
        $this->db->exec("CREATE TABLE IF NOT EXISTS reviews (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            product_id INTEGER,
            rating INTEGER,
            comment TEXT,
            status TEXT DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // ایجاد جدول review_replies
        $this->db->exec("CREATE TABLE IF NOT EXISTS review_replies (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            review_id INTEGER,
            user_id INTEGER,
            reply TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // ایجاد جدول activity_logs
        $this->db->exec("CREATE TABLE IF NOT EXISTS activity_logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            action TEXT,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // ایجاد جدول settings
        $this->db->exec("CREATE TABLE IF NOT EXISTS settings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            key TEXT UNIQUE,
            value TEXT
        )");

        // ایجاد جدول translations
        $this->db->exec("CREATE TABLE IF NOT EXISTS translations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            lang TEXT NOT NULL,
            key TEXT NOT NULL,
            value TEXT NOT NULL,
            UNIQUE(lang, key)
        )");
    }
}