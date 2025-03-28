-- تغییر نام ستون name به title
ALTER TABLE products RENAME COLUMN name TO title;

-- اضافه کردن ستون‌های جدید
ALTER TABLE products ADD COLUMN images TEXT;
ALTER TABLE products ADD COLUMN videos TEXT;
ALTER TABLE products ADD COLUMN attributes TEXT;
ALTER TABLE products ADD COLUMN status TEXT DEFAULT 'active';
ALTER TABLE products ADD COLUMN updated_at TIMESTAMP;

-- ستون seller_id رو نگه می‌داریم چون توی مدل قدیمی وجود داره