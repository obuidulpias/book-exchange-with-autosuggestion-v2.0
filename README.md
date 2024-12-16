# An Online Book Exchange System with Automatic Suggestions

An Online Book Exchange System with Automatic Suggestions is a web application which is for students, book lovers and all who need books. Users can exchange their extra/unnecessary books with other users and users can also buy books.

## Installation

Use this line to cloning your project

```bash
git clone
```

Install Composer Dependencies

```bash
composer install
```

Create a .env file if it does not already exist. You can copy the .env.example

```bash
DB_DATABASE=
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
