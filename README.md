## PharmaCES System

Simple pharmacy management system (AdminLTE UI) with inventory, sales, reports, and returns.

### Features

- Sells
  - Sell by name (`sells.php`) and by barcode (`sellsbybar.php`)
  - Discounts (percentage/value), order completion/cancellation
  - Returns workflow (`returns.php`) that restores stock and records refund in accounts
- Inventory
  - Items, prices, quantities, package sizes, limits, barcodes
  - Low stock report comparing `item_quantity` vs `item_limmit`
- Users & Suppliers
  - User management, suppliers management
  - Reports: Users List, Suppliers List
- Dashboard
  - Live counts for today’s orders, staff, tests (sample), medicines
- Reports
  - Accounts summary with date filters
  - Sales by period (grouped by day)
  - Drugs inventory (name, quantity, price, package, limit, barcode presence)

### Security & Improvements

- Prepared statements on critical write paths
- Password hashing and secure login (`password_hash`/`password_verify`)
- Session/auth guard for non-public pages
- Output sanitization in reports

### Getting Started

1) Requirements
- PHP 7.4+ (mysqli), MySQL/MariaDB
- Apache/Nginx with PHP enabled

2) Database
- Import the sample database in `database/mmc17-1-2023.sql` (optional)
- Or create a new database and run your own schema

3) Configuration
- Configure database connection in `code/connection.php`.
- Recommended: set environment variables before running the app:
  - `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`
- Fallback defaults (if env is missing) are currently:
  - host: `localhost`
  - user: `root`
  - pass: `oracleoracle`
  - db:   `mmc`

IMPORTANT: Check and change database names, usernames and passwords before deploying or pushing to GitHub.

4) Run
- Serve the `code/` directory on a local web server (e.g., Apache vhost or PHP’s built-in server)
  - Example: `php -S 127.0.0.1:8000 -t code`
- Visit `http://127.0.0.1:8000/login.php`

### Project Structure

- `code/` application PHP files (pages, includes)
- `database/` SQL dump and utility scripts
- `code/bower_components/`, `code/dist/` front-end assets (AdminLTE, Bootstrap, jQuery)

### Notes

- For production, do not commit SQL dumps or credentials.
- Consider adding CSRF tokens to forms and finishing the migration to prepared statements everywhere.
- Legacy backup utility exists (`code/dumper*.php`); restrict access or remove in deployments.
