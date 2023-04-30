
# Simple library management app
## Features
- Authorization for employees.
- Registration for readers.
- Ability to leave comments for readers
- CRUD for books, categories, users (including API)
- Sending email notification when an employee is added
- Importing books from an Excel file (using queue)
## Requirements
- PHP >= 8.1
- Composer
- Node.js >= v18.15.0
- A relational database (MySQL, PostgreSQL, sqlite.)

## Installation
1. Clone the repository:
```bash
git clone https://github.com/qwfpg/library-example.git
```
2. Navigate to the project directory:
```bash
cd library-app
```
3. Install dependencies using Composer:
```bash
composer install
```
4. Install frontend dependencies and build assets:
```bash
npm install
npm run build
```
5. Create an `.env` file based on `.env.example`:
```bash
cp .env.example .env
```
6. Generate an application key:
```bash
php artisan key:generate
```
7. Configure the database connection settings in the `.env` file. Replace the following values with your own:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
8. Configure mail settings
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_google_user_name
MAIL_PASSWORD=your_google_user_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
```
9. Configure credentials for default admin user
```
ADMIN_EMAIL='admin@domain.com'
ADMIN_PASSWORD='password'
```
10. Run the database migrations
```
php artisan migrate --seed
```
11. Link storage folder
```
php aritsan storage:link
```
12. Start the development server:
```
php artisan serve
```
13. To process jobs from the queue, run the queue worker in a separate terminal:
```
php artisan queue:work
```
