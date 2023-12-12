# Book Store Management System

This is a Book Store Management System built with Laravel 8 and PHP 7.4. It allows you to manage customers, book categories, books, and sales.

## Features

### Customer Management

- Search for customer by customer name
- View a list of customers.
- Add new customers.
- Edit existing customer information.
- Delete customers.

### Category Management

- Search for categories by category name
- View a list of book categories.
- Add new book categories.
- Update book category information.
- Delete book categories.

### Book Management

- Search for books by book name, author, and category name.
- View a list of book
- Add new books.
- Update book information.
- Delete books.

### Selling Books

- Search for sold books by book name and customer
- View a list of sold book
- Add selling records with book name, customer name, quantity, and discount.
- And also update and delete the records
- Calculate the total amount for the sold books.
- Enter the amount to pay for the sold books.

### Report

- Search by customer name
- View a summery list of customer with the total of quantity, discount, total, and paid in all days

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 7.4 or higher installed.
- Composer installed.
- MySQL or another supported database system installed.
- Laravel 8 installed.

## Installation

Follow these steps to install and set up the Book Store Management System:

1. Clone the repository:

   ```bash
   git clone https://github.com/Htet-Lin-Aung/book-store-management.git

2. Navigate to the project directory:

    ```bash
    cd book-store-management

3. Install the project dependencies using Composer:

    ```bash
    composer install

4. Create a .env file by copying the example:

    ```bash
    cp .env.example .env //for linux
    scp .env.example .env //for windows

5. Generate a new application key:

    ```bash
    php artisan key:generate

6. Configure your database connection in the .env file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=your-database-host
    DB_PORT=3306
    DB_DATABASE=your-database-name
    DB_USERNAME=your-database-username
    DB_PASSWORD=your-database-password

7. Run database migrations and seed the database:

    ```bash
    php artisan migrate --seed

8. Start the development server:

    ```bash
    php artisan serve

9. Access the application in your web browser at http://localhost:8000.

10. You can now log in to the application using the default administrator account:

    Email: admin@gmail.com
    Password: @dm!nU$er

## Usage

### Web Interface

- Log in to the application using your administrator credentials.
- Use the navigation menu to access customer, category, book, and sale management features.
- Manage customers, categories, books, and sales as needed.

## API

#### API Documentation

- The API is accessible at `/api`.
- API documentation can be found at [API Documentation](API.md).

#### Authentication

- To access the API, you need to authenticate using OAuth 2.0 or API tokens.
- See the [API Authentication](API.md) section for details on authentication methods.

#### API Endpoints

- Customers API: `/api/customers`
- Categories API: `/api/categories`
- Books API: `/api/books`
- Sales API: `/api/sales`
- Reports API: `api/reports`

For detailed API documentation, including available endpoints and authentication methods, please refer to the [API Documentation](API.md) file.

## Credits

This application was created by Htet Lin Aung.
