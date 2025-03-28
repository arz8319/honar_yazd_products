CREATE TABLE IF NOT EXISTS categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    parent_id INTEGER, -- برای دسته‌بندی‌های درختی
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);