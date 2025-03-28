# API Documentation

## Base URL
`http://yourdomain.com/api`

## Authentication
Some endpoints require authentication. Include the `Authorization` header with your API token:

Authorization: Bearer your-token
text

## Endpoints

### Products
- **GET /products**
- Description: List all products
- Parameters:
- `search` (optional): Search term for product name or description
- `category_id` (optional): Filter by category ID
- Response: `200 OK`
```json
[
{
"id": 1,
"name": "Product 1",
"description": "Description 1",
"price": 100,
"category_id": 1
},
...
]

GET /product/{id}
Description: Get a specific product
Response: 200 OK
json

{
"id": 1,
"name": "Product 1",
"description": "Description 1",
"price": 100,
"category_id": 1
}

Cart

POST /cart/add
Description: Add a product to the cart (requires authentication)
Body:
json

{
"product_id": 1,
"quantity": 1
}
Response: 200 OK
json

{
"message": "Product added to cart"
}

Orders

POST /orders/create
Description: Create an order (requires authentication)
Response: 200 OK
json

{
"order_id": 1,
"total": 100
}

Tickets

POST /tickets/create
Description: Create a support ticket (requires authentication)
Body:
json

{
"subject": "Issue with order",
"description": "I have a problem with my order."
}
Response: 200 OK
json

{
"message": "Ticket created"
}

Notifications

GET /notifications
Description: List user notifications (requires authentication)
Response: 200 OK
json

[
{
"id": 1,
"message": "Payment for order #1 was successful.",
"created_at": "2025-03-20 10:00:00"
},
...
]
