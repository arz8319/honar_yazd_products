CREATE INDEX IF NOT EXISTS idx_notifications_user_id ON notifications(user_id);
CREATE INDEX IF NOT EXISTS idx_discounts_product_id ON discounts(product_id);
CREATE INDEX IF NOT EXISTS idx_shipping_order_id ON shipping(order_id);