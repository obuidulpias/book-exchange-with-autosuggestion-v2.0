# User Role Permission

A simple user role management system by using two packages - Spatie and Passport. Spatie use for assigning role permission to user and Passport use for user authentication. And I follow repository design pattern to give good architect.

## Installation

Use this line to cloning your project

```bash
git clone https://github.com/obuidulpias/user-role-management-system.git
```

Install Composer Dependencies

```bash
composer install
```

Create a .env file if it does not already exist. You can copy the .env.example

```bash
DB_DATABASE=user_role
```

Generate an Application Key

```bash
php artisan key:generate
```

Migrate the Database

```bash
php artisan migrate
```

For passport set up

```bash
php artisan passport:client --personal
or
php artisan passport:install
```

Finally run this command

```bash
php artisan serve
The application will be accessible at: http://127.0.0.1:8000
```

## API Documentation and endpoints link

[API Documentation and endpoints](https://documenter.getpostman.com/view/12482884/2sAYBd67bb#intro)
