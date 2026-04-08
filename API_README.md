# 🍽️ Restaurant API Documentation

## 📌 Overview

This is a public API for the Restaurant Management System that allows fetching menu items and food details without authentication. Perfect for mobile apps, web clients, and integrations.

**Base URL:** `http://localhost/Restoran/api`

---

## 🔓 Public Endpoints (No Authentication Required)

### 1. Get All Foods/Menus

**Endpoint:** `GET /api/public/foods`

**Description:** Retrieve a list of all available food items in the restaurant menu.

**Request:**

```bash
curl -X GET "http://localhost/Restoran/api/public/foods" \
  -H "Accept: application/json"
```

**URL:**

```
http://localhost/Restoran/api/public/foods
```

**Response (200 - Success):**

```json
{
    "success": true,
    "message": "List Data Food",
    "data": [
        {
            "id": 1,
            "name": "Nasi Goreng",
            "description": "Delicious fried rice with vegetables and protein",
            "price": "50000.00",
            "image": "images/food/1234567890.jpg",
            "image_url": "http://localhost/Restoran/images/food/1234567890.jpg",
            "created_at": "2026-03-29T13:25:46.000000Z",
            "updated_at": "2026-03-29T13:25:46.000000Z"
        },
        {
            "id": 2,
            "name": "Mie Goreng",
            "description": "Spicy fried noodles",
            "price": "40000.00",
            "image": "images/food/1234567891.jpg",
            "image_url": "http://localhost/Restoran/images/food/1234567891.jpg",
            "created_at": "2026-03-29T13:26:15.000000Z",
            "updated_at": "2026-03-29T13:26:15.000000Z"
        }
    ]
}
```

**Query Parameters:**

- None

---

### 2. Get Single Food/Menu by ID

**Endpoint:** `GET /api/public/foods/{id}`

**Description:** Retrieve detailed information about a specific food item.

**Parameters:**

- `id` (required) - The ID of the food item (numeric)

**Request:**

```bash
curl -X GET "http://localhost/Restoran/api/public/foods/1" \
  -H "Accept: application/json"
```

**URL:**

```
http://localhost/Restoran/api/public/foods/1
```

**Response (200 - Success):**

```json
{
    "success": true,
    "message": "Food details",
    "data": {
        "id": 1,
        "name": "Nasi Goreng",
        "description": "Delicious fried rice with vegetables and protein",
        "price": "50000.00",
        "image": "images/food/1234567890.jpg",
        "image_url": "http://localhost/Restoran/images/food/1234567890.jpg",
        "created_at": "2026-03-29T13:25:46.000000Z",
        "updated_at": "2026-03-29T13:25:46.000000Z"
    }
}
```

**Response (404 - Not Found):**

```json
{
    "success": false,
    "message": "Food not found"
}
```

---

## 🔐 Protected Endpoints (Authentication Required)

> ⚠️ These endpoints require authentication using Sanctum tokens. Include the token in the Authorization header.

### 3. Create New Food/Menu

**Endpoint:** `POST /api/foods`

**Description:** Create a new food item (Admin/Authenticated users only).

**Headers:**

```
Authorization: Bearer YOUR_SANCTUM_TOKEN
Content-Type: multipart/form-data
```

**Request Body:**

```
name: "Soto Ayam"
description: "Traditional chicken soup"
price: 35000
image: (binary file)
```

**CURL Example:**

```bash
curl -X POST "http://localhost/Restoran/api/foods" \
  -H "Authorization: Bearer your_token_here" \
  -F "name=Soto Ayam" \
  -F "description=Traditional chicken soup" \
  -F "price=35000" \
  -F "image=@/path/to/image.jpg"
```

**Response (201 - Created):**

```json
{
    "success": true,
    "message": "Food created successfully",
    "data": {
        "id": 3,
        "name": "Soto Ayam",
        "description": "Traditional chicken soup",
        "price": "35000.00",
        "image": "images/1234567892.jpg",
        "updated_at": "2026-03-30T10:15:30.000000Z",
        "created_at": "2026-03-30T10:15:30.000000Z"
    }
}
```

**Response (422 - Validation Error):**

```json
{
    "success": false,
    "message": "Validation failed",
    "data": {
        "name": ["The name field is required."],
        "price": ["The price field is required."]
    }
}
```

---

### 4. Update Food/Menu

**Endpoint:** `PUT /api/foods/{id}`

**Description:** Update an existing food item (Admin/Authenticated users only).

**Headers:**

```
Authorization: Bearer YOUR_SANCTUM_TOKEN
Content-Type: multipart/form-data
```

**Parameters:**

- `id` (required) - The ID of the food item

**Request Body:**

```
name: "Nasi Goreng Special"
description: "Premium fried rice with special sauce"
price: 65000
image: (binary file - optional)
```

**CURL Example:**

```bash
curl -X PUT "http://localhost/Restoran/api/foods/1" \
  -H "Authorization: Bearer your_token_here" \
  -F "name=Nasi Goreng Special" \
  -F "description=Premium fried rice with special sauce" \
  -F "price=65000" \
  -F "image=@/path/to/new_image.jpg"
```

**Response (200 - Success):**

```json
{
    "success": true,
    "message": "Food updated successfully",
    "data": {
        "id": 1,
        "name": "Nasi Goreng Special",
        "description": "Premium fried rice with special sauce",
        "price": "65000.00",
        "image": "images/1234567893.jpg",
        "created_at": "2026-03-29T13:25:46.000000Z",
        "updated_at": "2026-03-30T10:20:15.000000Z"
    }
}
```

**Response (404 - Not Found):**

```json
{
    "success": false,
    "message": "Food not found"
}
```

---

### 5. Delete Food/Menu

**Endpoint:** `DELETE /api/foods/{id}`

**Description:** Delete a food item (Admin/Authenticated users only).

**Headers:**

```
Authorization: Bearer YOUR_SANCTUM_TOKEN
```

**Parameters:**

- `id` (required) - The ID of the food item to delete

**CURL Example:**

```bash
curl -X DELETE "http://localhost/Restoran/api/foods/1" \
  -H "Authorization: Bearer your_token_here"
```

**Response (200 - Success):**

```json
{
    "success": true,
    "message": "Food deleted successfully"
}
```

**Response (404 - Not Found):**

```json
{
    "success": false,
    "message": "Food not found"
}
```

---

## 🧪 Testing with Postman

### Step 1: Import Requests

Create a new Postman Collection and add the following requests:

#### Request 1: Get All Foods (Public)

- **Method:** GET
- **URL:** `http://localhost/Restoran/api/public/foods`
- **Headers:**
    - `Accept: application/json`

#### Request 2: Get Single Food (Public)

- **Method:** GET
- **URL:** `http://localhost/Restoran/api/public/foods/1`
- **Headers:**
    - `Accept: application/json`

#### Request 3: Create Food (Protected)

- **Method:** POST
- **URL:** `http://localhost/Restoran/api/foods`
- **Headers:**
    - `Authorization: Bearer YOUR_TOKEN`
    - `Accept: application/json`
- **Body (form-data):**
    - `name` (text): Soto Ayam
    - `description` (text): Traditional chicken soup
    - `price` (text): 35000
    - `image` (file): Select an image file

#### Request 4: Update Food (Protected)

- **Method:** PUT
- **URL:** `http://localhost/Restoran/api/foods/1`
- **Headers:**
    - `Authorization: Bearer YOUR_TOKEN`
    - `Accept: application/json`
- **Body (form-data):**
    - `name` (text): Updated name
    - `description` (text): Updated description
    - `price` (text): 45000
    - `image` (file): Optional - select new image

#### Request 5: Delete Food (Protected)

- **Method:** DELETE
- **URL:** `http://localhost/Restoran/api/foods/1`
- **Headers:**
    - `Authorization: Bearer YOUR_TOKEN`

---

## 📝 Common Use Cases

### Example 1: Fetch Menu List

Perfect for displaying available items on a restaurant app or website.

```bash
GET http://localhost/Restoran/api/public/foods

# Response contains all menu items with prices, descriptions, and images
```

### Example 2: Get Food Details

Get complete information about a specific dish before ordering.

```bash
GET http://localhost/Restoran/api/public/foods/1

# Returns detailed food information including image URL
```

### Example 3: Mobile App Integration

JavaScript example for front-end integration:

```javascript
// Fetch all foods
fetch("http://localhost/Restoran/api/public/foods")
    .then((response) => response.json())
    .then((data) => {
        console.log("Available meals:", data.data);
        // Display in your app
    });

// Fetch single food
fetch("http://localhost/Restoran/api/public/foods/1")
    .then((response) => response.json())
    .then((data) => {
        console.log("Food details:", data.data);
    });
```

---

## 🔧 Error Handling

### Error Codes

| Code | Message              | Description                             |
| ---- | -------------------- | --------------------------------------- |
| 200  | OK                   | Request successful                      |
| 201  | Created              | Resource created successfully           |
| 404  | Not Found            | Food item not found                     |
| 422  | Unprocessable Entity | Validation error                        |
| 401  | Unauthorized         | Missing or invalid authentication token |
| 500  | Server Error         | Internal server error                   |

### Response Format for Errors

```json
{
    "success": false,
    "message": "Error message here",
    "data": null
}
```

---

## 💡 Tips & Best Practices

1. **Rate Limiting**: Currently no rate limiting, but implement if needed for production
2. **Caching**: Cache GET requests to reduce database load
3. **Pagination**: Can be added to `GET /api/public/foods` for large datasets
4. **Filtering**: Future enhancement - filter by category, price range, etc.
5. **Search**: Future enhancement - search food by name or description
6. **Image URLs**: Full URLs are provided in `image_url` field for easy integration

---

## 🚀 Quick Start for Postman Testing

1. Open Postman
2. Create new requests using the endpoints above
3. For **public endpoints**: Just use GET requests - no authentication needed!
4. Try fetching: `http://localhost/Restoran/api/public/foods`
5. You should see all available food items with images and prices

---

## 📞 Support

For issues or questions about the API:

- Check the response messages for specific errors
- Verify the database has food items (`php artisan migrate`)
- Ensure app is running: `php artisan serve` or access via XAMPP

---

**Last Updated:** April 8, 2026  
**API Version:** 1.0
