CREATE TABLE IF NOT EXISTS activity_logs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    action TEXT, -- e.g., "login", "update_product"
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);