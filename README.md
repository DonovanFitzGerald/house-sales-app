# House Sales App

A simple house CRUD app built with Laravel and Tailwind CSS.

## Features

- User authentication (login, register, logout)
- House listing with search filtering
- House listing pagination
- House details page
- House creation **_admin only_**
- House update **_admin only_**
- House deletion **_admin only_**

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
npm run start
```

### Useful Commands

```bash
# Run the formatter
./vendor/bin/pint
```
