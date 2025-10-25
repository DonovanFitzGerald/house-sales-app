web.php:

- Talk about get routes calling the controller to return a view (index and show)
- Put, Post and Delete routes are for crud operations

Controller:

- Runs scripts which are called by web.php
- Uses the model to interact with the database

Search box:

- Passes an argument into the index method of the controller
- Uses the eloquent ORM ( The built in laravel code for interacting with the DB ) to run a filtered search on the database

Migrations:

- Defines the structure for the database
- User migration for adding admin users

Seeders:

- Faker class used for creating realistic fake data ( calling the build in methods eg. $faker -> address() )

Components:

- Reusable php which generates html
- Takes in **props** which allows data to be passed into the component

Laravel blade:

- Shorthand code for php eg. @php @foreach @if

# Video flow

1. Go through as normal user
    - Index
    - Show
        - Breadcrumbs
    - Search
        - Takes a request
        - Eloquent sql
        - Pagination
        - Preserves query string
2. Go through as admin user
    - Create Page
        - House form component
        - Preview script
        - Success alert
    - Edit
    - Delete
