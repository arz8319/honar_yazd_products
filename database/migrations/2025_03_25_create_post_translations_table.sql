CREATE TABLE IF NOT EXISTS post_translations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    post_id INTEGER NOT NULL,
    lang TEXT NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    UNIQUE(post_id, lang),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id)
);