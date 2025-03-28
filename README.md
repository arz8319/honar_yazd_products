# Honar Yazd Products

A simple e-commerce platform built with PHP, SQLite, and Tailwind CSS.

## Features
- User authentication (login/register)
- Product listing with search and category filter
- Shopping cart and order management
- Discount system
- Payment integration with Zarinpal
- Notification system
- Support tickets
- Admin dashboard for managing users, products, tickets, and discounts
- Blog and polls
- Multi-language support (Farsi, English, Arabic)
- SEO optimization
- Unit tests

## Installation
1. Clone the repository:
```bash
git clone https://github.com/your-repo/honar_yazd_products.git

Navigate to the project directory:
bash

cd honar_yazd_products
Set up the database:

Create a SQLite database file database.db in the root directory.
Run the SQL scripts in database.sql to create the necessary tables and seed data.

Configure environment variables:

Copy .env.example to .env and set your Zarinpal Merchant ID:
text

ZARINPAL_MERCHANT_ID=your-merchant-id

Start a PHP server:
bash

php -S localhost:8000
Visit http://localhost:8000 in your browser.

Usage

Home Page: Browse featured products and blog posts.
Products: Search and filter products by category.
Cart: Add products to your cart and proceed to checkout.
Orders: View your orders and initiate payment.
Tickets: Submit support tickets and view responses.
Notifications: Receive updates on your orders and payments.
Admin Dashboard: Manage users, products, tickets, and discounts (accessible to admin users only).

API Endpoints

GET /api/products: List all products
GET /api/product/{id}: Get a specific product
POST /api/cart/add: Add a product to the cart
POST /api/orders/create: Create an order

Testing

Run the unit tests using:
bash
php tests/run.php
Contributing

Fork the repository.
Create a new branch (git checkout -b feature/your-feature).
Commit your changes (git commit -m 'Add your feature').
Push to the branch (git push origin feature/your-feature).
Create a Pull Request.

License

This project is licensed under the MIT License.