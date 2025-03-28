## Order Endpoints

### Get Orders
- **URL**: `/api/orders/{userId}`
- **Method**: `GET`
- **Description**: Retrieves all orders for a specific user.
- **Response**:
```json
[
{
"id": 1,
"user_id": 1,
"total": 199.99,
"status": "pending",
"created_at": "2025-03-20 10:00:00"
}
]
Create Order

URL: /api/orders
Method: POST
Description: Creates a new order for a user.
Body:
json

{
"user_id": 1,
"items": [
{"product_id": 1, "quantity": 2},
{"product_id": 2, "quantity": 1}
],
"address": "123 Main St, Tehran"
}
Response:
json

{
"order_id": 2,
"total": 1499.97,
"status": "pending"
}
