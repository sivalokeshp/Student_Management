# Student Management System (PHP + MySQL)

## What is included
- User registration & login (password hashing)
- Session-based authentication
- CRUD operations for students (add, view, edit, delete)
- Simple CSS for layout

## Setup
1. Install a local server: XAMPP/WAMP/MAMP.
2. Start Apache and MySQL.
3. Create the database:
   - Open phpMyAdmin or MySQL CLI.
   - Import `student_db.sql` or run its SQL commands.
4. Place project folder in your server's document root (e.g., `htdocs`).
5. Edit `db.php` if your DB user/password differs.
6. Visit `http://localhost/student-management/login.php` and register a user.

## Notes
- Use prepared statements (already used) to prevent SQL injection.
- Use `password_hash()` and `password_verify()` for secure passwords.
- This is a basic starter project; you can extend it with validation, file upload, user roles, pagination, and search.
