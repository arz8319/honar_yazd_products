## Mobile API Endpoints

### Get Products
- **URL**: `/api/mobile/products`
- **Method**: `GET`
- **Response**:
```json
[
{
"id": 1,
"name": "Smartphone X",
"description": "A high-end smartphone with great features.",
"price": 699.99,
"stock": 50
}
]
Get Cart

URL: /api/mobile/cart/{userId}
Method: GET
Response:
json

{
"id": 1,
"user_id": 1,
"items": "{\"1\": 2}"
}

Calculate Total

URL: /api/mobile/total/{userId}
Method: GET
Response:
json

{
"total": 1399.98
}
