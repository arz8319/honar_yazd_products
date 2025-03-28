# Database Schema

## Table: roles
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- name: VARCHAR(255)

## Table: users
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- name: VARCHAR(255)
- username: VARCHAR(255)
- email: VARCHAR(255) UNIQUE
- password: TEXT
- role_id: INTEGER
- created_at: DATETIME
- role: TEXT DEFAULT 'user'

## Table: carts
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- user_id: INTEGER
- items: TEXT

## Table: categories
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- name: VARCHAR(255)
- parent_id: INTEGER

## Table: products
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- name: VARCHAR(255)
- price: DECIMAL(10, 2)
- description: TEXT
- image: VARCHAR(255)
- created_at: DATETIME
- featured: INTEGER DEFAULT 0
- stock: INTEGER DEFAULT 0
- category_id: INTEGER
- images: TEXT DEFAULT '[]'
- videos: TEXT DEFAULT '[]'
- attributes: TEXT DEFAULT '[]'

## Table: discounts
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- product_id: INTEGER
- percentage: DECIMAL(5, 2)
- start_date: DATETIME
- end_date: DATETIME
- category_id: INTEGER

## Table: orders
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- user_id: INTEGER
- total_price: DECIMAL(10, 2)
- status: TEXT DEFAULT 'pending'
- created_at: TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Table: order_items
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- order_id: INTEGER
- product_id: INTEGER
- quantity: INTEGER
- price: DECIMAL(10, 2)

## Table: reviews
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- user_id: INTEGER
- product_id: INTEGER
- rating: INTEGER
- comment: TEXT
- status: TEXT DEFAULT 'pending'
- created_at: TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Table: review_replies
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- review_id: INTEGER
- user_id: INTEGER
- reply: TEXT
- created_at: TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Table: activity_logs
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- user_id: INTEGER
- action: TEXT
- description: TEXT
- created_at: TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Table: settings
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- key: TEXT UNIQUE
- value: TEXT

## Table: translations
- id: INTEGER PRIMARY KEY AUTOINCREMENT
- lang: TEXT NOT NULL
- key: TEXT NOT NULL
- value: TEXT NOT NULL
- UNIQUE(lang, key)