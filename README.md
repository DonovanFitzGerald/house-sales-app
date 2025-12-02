# House Sales App

A house listing management app built with Laravel 12, Blade, Tailwind CSS, Alpine.js, and Breeze. This application provides a platform for browsing and managing house listings.
This project features a responsive design built with Tailwind CSS and powered by Laravel's framework. The application supports three user roles: regular users who can browse and place bids, realtors who manage their assigned listings, and administrators who have full CRUD capabilities for managing listings and assigning realtors.

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

### Realtor Management

- **Realtor Listings**: Browse all available realtors with their details
- **Realtor Profiles**: View individual realtor profiles with assigned house listings
- **Realtor Assignment**: Assign multiple realtors to house listings (Admin only)
- **Realtor Dashboard**: Realtors can view their assigned listings
- **Search Filtering**: Search realtors by name or email

### Bidding System

- **Place Bids**: Users can place bids on house listings
- **Bid History**: View all bids on a property sorted by highest value
- **Top Bid Display**: See the highest bid for each property
- **Bid Tracking**: Users can track houses they've bid on

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

- Email: `donovan@admin.com`
- Password: `password`

**Realtor Account:**

- Email: `donovan@realtor.com`
- Password: `password`

**Regular User Account:**

- Email: `donovan@user.com`
- Password: `password`

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
- `phone_number`: User's phone number (optional)
- `password`: Hashed password
- `role`: User role (admin/user/realtor)
- `featured_image`: Filename of the user's profile image (optional)
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

### House_User Table (Realtor Assignment)

- `id`: Primary key
- `user_id`: Foreign key to users table (realtor)
- `house_id`: Foreign key to houses table
- `created_at`, `updated_at`: Timestamps
- Unique constraint on (house_id, user_id) to prevent duplicate assignments

### Bids Table

- `id`: Primary key
- `user_id`: Foreign key to users table (bidder)
- `house_id`: Foreign key to houses table
- `value`: Bid amount (integer)
- `created_at`, `updated_at`: Timestamps
