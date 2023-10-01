# API Documentation

This documentation provides details about the endpoints available in the API.

## Authentication

The following endpoints require authentication:

- [POST /api/register](#post-apiregister): Register a new user.
- [POST /api/login](#post-apilogin): Log in as a user to obtain an authentication token.

To access authenticated endpoints, you must include the authentication token in the request headers.

## User Endpoints

### Register a New User

- **URL:** `/api/register`
- **Method:** POST
- **Description:** Register a new user.
- **Request Body:** JSON object with user registration data.
- **Response:** JSON object with user details and authentication token.

### Log in as a User

- **URL:** `/api/login`
- **Method:** POST
- **Description:** Log in as a user to obtain an authentication token.
- **Request Body:** JSON object with user login credentials.
- **Response:** JSON object with user details and authentication token.

## Category Endpoints

### List All Categories

- **URL:** `/api/category`
- **Method:** GET
- **Description:** Get a list of all categories.
- **Response:** JSON array containing category details.

### Search for Categories

- **URL:** `/api/category/search/categories`
- **Method:** GET
- **Description:** Search for categories by keyword.
- **Query Parameters:** `search` (string) - The keyword to search for.
- **Response:** JSON array containing matching category details.

### Get Category Details

- **URL:** `/api/category/{id}`
- **Method:** GET
- **Description:** Get details of a specific category by ID.
- **Response:** JSON object containing category details.

### Create a New Category

- **URL:** `/api/category`
- **Method:** POST
- **Description:** Create a new category.
- **Request Body:** JSON object with category data.
- **Response:** JSON object containing the newly created category.

### Update a Category

- **URL:** `/api/category/{id}`
- **Method:** PUT
- **Description:** Update an existing category by ID.
- **Request Body:** JSON object with updated category data.
- **Response:** JSON object containing the updated category.

### Delete a Category

- **URL:** `/api/category/{id}`
- **Method:** DELETE
- **Description:** Delete a category by ID.

## Book Endpoints

### List All Books

- **URL:** `/api/book`
- **Method:** GET
- **Description:** Get a list of all books.
- **Response:** JSON array containing book details.

### Search for Books

- **URL:** `/api/book/search/books`
- **Method:** GET
- **Description:** Search for books by keyword.
- **Query Parameters:** `search` (string) - The keyword to search for.
- **Response:** JSON array containing matching book details.

### Get Book Details

- **URL:** `/api/book/{id}`
- **Method:** GET
- **Description:** Get details of a specific book by ID.
- **Response:** JSON object containing book details.

### Create a New Book

- **URL:** `/api/book`
- **Method:** POST
- **Description:** Create a new book.
- **Request Body:** JSON object with book data.
- **Response:** JSON object containing the newly created book.

### Update a Book

- **URL:** `/api/book/{id}`
- **Method:** PUT
- **Description:** Update an existing book by ID.
- **Request Body:** JSON object with updated book data.
- **Response:** JSON object containing the updated book.

### Delete a Book

- **URL:** `/api/book/{id}`
- **Method:** DELETE
- **Description:** Delete a book by ID.

## Customer Endpoints (Authenticated)

(Authentication token required for access)

### List All Customers

- **URL:** `/api/customer`
- **Method:** GET
- **Description:** Get a list of all customers.
- **Response:** JSON array containing customer details.

### Search for Customers

- **URL:** `/api/customer/search/customers`
- **Method:** GET
- **Description:** Search for customers by keyword.
- **Query Parameters:** `search` (string) - The keyword to search for.
- **Response:** JSON array containing matching customer details.

### Get Customer Details

- **URL:** `/api/customer/{id}`
- **Method:** GET
- **Description:** Get details of a specific customer by ID.
- **Response:** JSON object containing customer details.

### Update Customer Details

- **URL:** `/api/customer/{id}`
- **Method:** PUT
- **Description:** Update customer details for the authenticated customer.
- **Request Body:** JSON object with updated customer data.
- **Response:** JSON object containing the updated customer details.

### Delete a Customer

- **URL:** `/api/customer/{id}`
- **Method:** DELETE
- **Description:** Delete a customer by ID.

## Sale Endpoints (Authenticated)

(Authentication token required for access)

### List All Sales

- **URL:** `/api/sale`
- **Method:** GET
- **Description:** Get a list of all sales.
- **Response:** JSON array containing sale details.

### Search for Sales

- **URL:** `/api/sale/search/sales`
- **Method:** GET
- **Description:** Search for sales by keyword.
- **Query Parameters:** `search` (string) - The keyword to search for.
- **Response:** JSON array containing matching sale details.

### Get Sale Details

- **URL:** `/api/sale/{id}`
- **Method:** GET
- **Description:** Get details of a specific sale by ID.
- **Response:** JSON object containing sale details.

### Update Sale Details

- **URL:** `/api/sale/{id}`
- **Method:** PUT
- **Description:** Update sale details for the authenticated sale.
- **Request Body:** JSON object with updated sale data.
- **Response:** JSON object containing the updated sale details.

### Delete a Sale

- **URL:** `/api/sale/{id}`
- **Method:** DELETE
- **Description:** Delete a sale by ID.

## Report Endpoints (Authenticated)

(Authentication token required for access)

### List All Reports

- **URL:** `/api/report`
- **Method:** GET
- **Description:** Get a list of all reports.
- **Response:** JSON array containing report details.

### Search for Reports

- **URL:** `/api/report/search/reports`
- **Method:** GET
- **Description:** Search for reports by keyword.
- **Query Parameters:** `search` (string) - The keyword to search for.
- **Response:** JSON array containing matching report details.