
## Application Overview

This application is a web-based banking system developed using PHP and MySQL, with additional use of HTML5, CSS, and JavaScript. The software is designed to run on PHP version 5 and above and is compatible with any MySQL Database that supports PHP 5 and above.

## Key Features

- **Programming Paradigm:** The application is primarily coded using PHP Object-Oriented Programming (OOP) principles, ensuring a modular and organized codebase.

- **User Dashboards:**
  - **Admin Dashboard:** Accessible through the admin login, the admin dashboard provides administrative functionalities.
    - **Admin Login Credentials:**
      - Username: admin
      - Password: 1234

  - **Client Dashboard:** Users can log in using their individual accounts to access their banking features.
    - **Sample Customer Accounts:**
      - Username: john, Password: 1234
      - Username: jane, Password: 1234

- **Banking Operations:**
  - **Account Management:**
    - Add customer accounts
    - Delete customer accounts
    - Block/unblock customer accounts

  - **Funds Transfer:**
    - Transfer funds between accounts

## Getting Started

1. Clone the repository to your local machine.
2. Configure the database information in the "initialize.php" file.
3. Ensure your server environment supports PHP 5 and above.

## Admin Login

To access the admin dashboard, use the following credentials:

- **Username:** admin
- **Password:** 1234

## Sample Customer Accounts

For testing purposes, you can use the following sample customer accounts:

1. **John's Account:**
   - Username: john
   - Password: 1234

2. **Jane's Account:**
   - Username: jane
   - Password: 1234

## Banking Operations

- **Account Management:**
  - Add Customer: Admin can add new customer accounts.
  - Delete Customer: Admin can delete customer accounts.
  - Block/Unblock Customer: Admin can block or unblock customer accounts.

- **Funds Transfer:**
  - Users can transfer funds between their accounts.

## Database Configuration

Ensure the correct database information is set in the "initialize.php" file to establish a connection with the MySQL database.

```php
// initialize.php
    if(!defined("DATABASE_HOST")) define("DATABASE_HOST", 'your_database_host'); //Database server
    if(!defined("DATABASE_USERNAME")) define("DATABASE_USERNAME", 'your_database_username'); //Database username
    if(!defined("DATABASE_PASSWORD")) define("DATABASE_PASSWORD", 'your_database_password'); //Database password
    if(!defined("DATABASE_NAME")) define("DATABASE_NAME", 'your_database_name'); //Database name

```

## Disclaimer

This application is intended for educational and testing purposes only. It is crucial to implement robust security measures before deploying any banking system for real-world use.

Feel free to explore and contribute to the development of this banking application!
