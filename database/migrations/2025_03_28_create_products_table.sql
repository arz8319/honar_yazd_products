CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT,
    price REAL NOT NULL,
    category_id INTEGER,
    stock INTEGER DEFAULT 0,
    images TEXT, -- JSON array of image URLs
    videos TEXT, -- JSON array of video URLs
    attributes TEXT, -- JSON for attributes like color, size
    status TEXT DEFAULT 'active', -- active/inactive
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP
);