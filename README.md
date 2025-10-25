# House Sales App

A simple house sales app built with Laravel and Tailwind CSS.

## Features

- User authentication (login, register, logout)
- House listing with search and filter
- House details page
- House creation (admin only)
- House update (admin only)
- House deletion (admin only)

## Requirements

- PHP 8.2
- Composer
- Node.js
- NPM

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

4. Run the database migrations seeds

```bash
php artisan migrate --seed
```

5. Start the development server

```bash
php artisan start
```

### Useful Commands

```bash
# Run the formatter
./vendor/bin/pint
```
