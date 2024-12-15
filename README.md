# Laravel Library Management System

This document serves as a guide to set up the Laravel-based Library Management System and provides an overview of its features and functionality.

---

## Project Description

The **Library Management System** is a web-based application designed to facilitate efficient library operations. It includes features for managing books, members, and checkout processes, with a user-friendly interface for administrators. Key functionalities include:

- **Book Management**: Add, update, and manage book details, including stock availability.
- **Member Management**: Register new members and monitor their membership details.
- **Checkout Management**: Track book borrowing and return operations.
- **Real-Time Stock Management**: Automatically adjust stock levels during checkouts and returns.

---

## Prerequisites

Before setting up the project, ensure the following are installed on your system:

1. **PHP** (version 8.1 or higher)
2. **Composer** (Dependency Manager for PHP)
3. **Node.js** (for managing frontend assets)
4. **MySQL** (or any other database supported by Laravel)
5. **Git** (for version control)

---

## Setup Instructions

### 1. Clone the Repository

```bash
# Clone the repository from GitHub
$ git clone https://github.com/your-repository/library-management-system.git

# Navigate into the project directory
$ cd library-management-system
```

### 2. Install Dependencies

#### Backend (PHP Dependencies):

```bash
# Install Laravel backend dependencies
$ composer install
```

#### Frontend (Node.js Dependencies):

```bash
# Install frontend dependencies
$ npm install
```

### 3. Environment Configuration

1. Copy the `.env.example` file to create a new `.env` file:
   ```bash
   $ cp .env.example .env
   ```

2. Open the `.env` file and configure the following:
   
   - **Database Connection**:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=library_db
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```

   - **App Key**:
     ```bash
     # Generate the application key
     $ php artisan key:generate
     ```

### 4. Database Setup

```bash
$ php artisan migrate
```

### 5. Serve the Application

#### Local Development Server:

```bash
# Start the local Laravel development server
$ php artisan serve
```

#### Compile Frontend Assets:

```bash
# Compile assets for development
$ npm run dev

# (Optional) Compile assets for production
$ npm run prod
```

The application will now be accessible at `http://127.0.0.1:8000`.

---

## Features

### Book Management
- Add, edit, or delete books.
- Manage stock for each book.

### Member Management
- Register new members.
- Track membership validity.

### Checkout Management
- Borrow books with automatic stock adjustment.
- Return books and update stock.

### Admin Dashboard
- Monitor overall library operations from a centralized dashboard.

---

## Troubleshooting

### Common Issues:

1. **Error: "No application key set."**
   - Run `php artisan key:generate` to set the application key.

2. **Database Connection Error**:
   - Ensure the database credentials in the `.env` file match your local setup.
   - Confirm the database service is running.

3. **Frontend Build Errors**:
   - Ensure Node.js and npm are installed.
   - Delete `node_modules` and `package-lock.json`, then run `npm install`.

### Logs:
Check the logs in the `storage/logs` directory for detailed error information.

---

## Additional Commands

### Clear Cache:
```bash
$ php artisan cache:clear
$ php artisan config:clear
```

### Run Tests:
```bash
$ php artisan test
```


