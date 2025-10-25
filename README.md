# House Sales App

A house listing management app built with Laravel 12, Blade, Tailwind CSS, Alpine.js, and Breeze. This application provides a platform for browsing and managing house listings.
This project features a responsive design built with Tailwind CSS and powered by Laravel's framework. The application supports two user roles: regular users who can browse and administrators who have full CRUD capabilities for managing listings.

## Features

### User Management

- **User Registration**: Secure user registration, login, and logout functionality powered by Laravel Breeze
- **Role-Based Authorization**: CRUD operations locked behind admin role

### House Browsing

- **Reusable card component**: Browse available houses in a card-based grid layout
- **Search filtering**: View all houses with details matching a key search term
- **Pagination**: Using Laravel's built-in pagination
- **Detail view**: Detailed view for each house showing all information

### House Management (Admin Only)

- **Create**: Add new house listings with image upload preview
- **Update**: Edit existing house information using form modal
- **Delete**: Remove houses from the system
- **Form Validation**: Server-side validation for all house data

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js
- NPM
- MySQL database

## Technology Stack

- **Laravel 12**: PHP framework
- **Laravel Breeze**: Authentication for Laravel
- **Eloquent ORM**: Database management features
- **Blade Templates**: Front end templating for server-side rendering
- **Tailwind CSS**: CSS framework for inline styling
- **Alpine.js**: JavaScript framework for Laravel
- **Vite**: Front end compiler

### Development Tools

- **Laravel Pint**: PHP code formatter
- **Prettier**: Code formatter with Blade and Tailwind plugins

### Database

- **Migrations**: Commands to create and manage database schema
- **Seeders**: Populate database with sample data

## Installation

1. Clone the repository

```bash
git clone https://github.com/donovanfitzgerald/house-sales-app.git
```

2. Install dependencies

```bash
composer install
npm install
```

3. Copy the `.env.example` file to `.env`, configure database details and generate an application key

```bash
php artisan key:generate
```

4. Run the database migrations and seeds

```bash
php artisan migrate --seed
```

5. Start the development server

```bash
npm run start
```

This command will run the Laravel and Vite development servers concurrently

### Default User Credentials

After running the database seeds, you can log in with the following credentials:

**Admin Account:**

- Email: `admin@example.com`
- Password: `password`

**Regular User Account:**

- Email: `donovan.fitzg@gmail.com`
- Password: `12345678`

### Useful Commands

```bash
# Run the formatter (Laravel Pint)
./vendor/bin/pint
```

## Database Schema

### Users Table

- `id`: Primary key
- `name`: User's full name
- `email`: Unique email address
- `password`: Hashed password
- `role`: User role (admin/user)
- `email_verified_at`: Email verification timestamp
- `remember_token`: Remember me token
- `created_at`, `updated_at`: Timestamps

### Houses Table

- `id`: Primary key
- `description`: House description
- `address_line_1`: Primary address line
- `address_line_2`: Secondary address line (optional)
- `city`: City name
- `county`: County name
- `zip`: ZIP/postal code
- `beds`: Number of bedrooms
- `baths`: Number of bathrooms
- `square_metres`: House size in square metres
- `energy_rating`: Energy efficiency rating (A1-G)
- `house_type`: Type of house (detached, semi-detached, etc.)
- `featured_image`: Filename of the uploaded image
- `created_at`, `updated_at`: Timestamps
