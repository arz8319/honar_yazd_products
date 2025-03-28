-- تغییر نام ستون role_id به role
ALTER TABLE users RENAME COLUMN role_id TO role;

-- تغییر نوع ستون role به TEXT و تنظیم مقدار پیش‌فرض
UPDATE users SET role = 'customer' WHERE role IS NULL;
UPDATE users SET role = 'admin' WHERE role = '1';
UPDATE users SET role = 'customer' WHERE role != 'admin';