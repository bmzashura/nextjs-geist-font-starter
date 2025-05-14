# Visitor Web App with CodeIgniter 4 and MySQL

This is a visitor management web application built with CodeIgniter 4 and MySQL.

## Features
- Visitor sign-in form with signature capture
- Visitor log with filtering and export to PDF
- Responsive UI similar to the provided design

## Setup Instructions

1. Install CodeIgniter 4 (already included in this folder)
2. Configure your MySQL database in `app/Config/Database.php`
3. Run the SQL script in `database/schema.sql` to create the visitors table
4. Start the development server:
   ```
   php spark serve
   ```
5. Access the app at `http://localhost:8080`

## Dependencies

- CodeIgniter 4
- MySQL
- TCPDF (for PDF export)
- Signature Pad JS (for signature capture)
