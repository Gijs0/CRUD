# Kledingwinkel Laravel Project

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Generate application key: `php artisan key:generate`
5. Configure database in `.env`
6. Run migrations: `php artisan migrate`
7. Seed database: `php artisan db:seed`
8. Start server: `php artisan serve`

## Default Users
- Admin: admin@example.com / password
- Customer: customer@example.com / password

## Features
- Product catalog with categories
- User registration and authentication
- Shopping cart functionality
- Order management
- Admin panel for product/order management
- Responsive design with Bootstrap

# Maak nieuwe Laravel project
composer create-project laravel/laravel kledingwinkel

# Navigeer naar project directory
cd kledingwinkel

# Maak migrations
php artisan make:migration create_categories_table
php artisan make:migration create_products_table
php artisan make:migration create_orders_table
php artisan make:migration create_order_items_table
php artisan make:migration add_role_to_users_table

# Maak models
php artisan make:model Category
php artisan make:model Product
php artisan make:model Order
php artisan make:model OrderItem

# Maak controllers
php artisan make:controller ProductController --resource
php artisan make:controller OrderController
php artisan make:controller CategoryController --resource

# Maak seeders
php artisan make:seeder CategorySeeder
php artisan make:seeder ProductSeeder
php artisan make:seeder UserSeeder

# Run migrations en seeders
php artisan migrate
php artisan db:seed

# Start development server
php artisan serve