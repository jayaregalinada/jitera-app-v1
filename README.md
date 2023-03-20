# Jitera Exam

## Requirements

- PHP >= `8.1`
- MySQL/MariaDB

## Installation

This project uses the latest or 10.x for Laravel

1. Run the composer installation

    ```bash
    composer install
    ```

2. Create a copy of `.env.example` and make your changes
3. Provision the database with seeder

    ```bash
    php artisan migrate --seed
    ```

4. Run the server

    ```bash
    php artisan serve 
    ```

## Bearer Token

To generate Token for request, you can run:

```bash
php artisan make:token <userId>
```

For more information, run `php artisan make:token --help`

## Testing

Simple run,:

```bash
vendor/bin/phpunit
```

***

###### Created and Developed by Jay Are Galinada
