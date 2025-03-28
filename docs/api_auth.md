## Authentication Endpoints

### Login
- **URL**: `/api/auth/login`
- **Method**: `POST`
- **Body**:
```json
{
"email": "user@example.com",
"password": "password123"
}

Response:
json

{
"token": "your-jwt-token"
}
Error Response:
json

{
"error": "Invalid credentials"
}
