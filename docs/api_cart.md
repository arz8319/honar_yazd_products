## Cart Endpoints

### Add to Cart
- **URL**: `/api/cart/add`
- **Method**: `POST`
- **Description**: Adds a product to the user's cart.
- **Body**:
```json
{
"user_id": 1,
"product_id": 1,
"quantity": 2
}

Response:
json

{
"success": true,
"message": "Product added to cart"
}

Remove from Cart

URL: /api/cart/remove
Method: POST
Description: Removes a product from the user's cart.
Body:
json

{
"user_id": 1,
"product_id": 1
}
Response:
json

{
"success": true,
"message": "Product removed from cart"
}
