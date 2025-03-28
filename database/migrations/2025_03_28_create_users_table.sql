CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'customer', -- customer/admin/editor
    status TEXT DEFAULT 'active', -- active/blocked
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);