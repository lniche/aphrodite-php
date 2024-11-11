# Aphrodite Laravel API Scaffold

Aphrodite is a template project based on [Laravel API Scaffold](https://github.com/redot-src/laravel-api-scaffold), designed to help developers get started quickly and deeply understand the use process of the framework. The project provides comprehensive sample code and configuration, covering common development scenarios, to facilitate learning and practice. In addition, Aphrodite also includes container deployment templates, making the project easy to deploy and manage in modern cloud environments, helping developers to efficiently build and release applications.

## Tech Stack

| Technology                                                                      | Description                                                                                                                                                                                       |
| ------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| [PHP](https://www.php.net/)                                                     | Required PHP version, PHP 8.2 or higher is required.                                                                                                                                              |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)                           | HTTP client library for sending HTTP requests and supporting REST API communication.                                                                                                              |
| [laravel/framework](https://github.com/laravel/framework)                       | Laravel framework core library, including all Laravel framework functions, such as routing, controllers, views, databases, etc.                                                                   |
| [laravel/sanctum](https://github.com/laravel/sanctum)                           | Laravel package for API authentication and authorization, providing a simple token authentication mechanism.                                                                                      |
| [laravel/tinker](https://github.com/laravel/tinker)                             | An interactive command line tool for interacting with Laravel applications, often used for debugging and performing tests.                                                                        |
| [spatie/laravel-query-builder](https://github.com/spatie/laravel-query-builder) | A package for building API queries, supporting filtering, sorting, paging, and other functions to help build scalable queries.                                                                    |
| [fakerphp/faker](https://github.com/FakerPHP/Faker)                             | A library for generating virtual data, often used for development and test data population.                                                                                                       |
| [laravel/pint](https://github.com/laravel/pint)                                 | Laravel's code style checker, similar to PHP CodeSniffer, but with some custom rules specifically for Laravel.                                                                                    |
| [laravel/sail](https://github.com/laravel/sail)                                 | Laravel's official Docker development environment simplifies the configuration of the development environment and is suitable for easily starting and running containers of Laravel applications. |
| [mockery/mockery](https://github.com/mockery/mockery)                           | Test double library, providing mock objects function for dependency injection and method call simulation in unit testing.                                                                         |
| [nunomaduro/collision](https://github.com/nunomaduro/collision)                 | Laravel error handling library, providing better error reporting and stack traces to improve the developer experience.                                                                            |
| [phpunit/phpunit](https://phpunit.de/)                                          | PHP testing framework, widely used for unit testing of PHP applications.                                                                                                                          |
| [spatie/laravel-ignition](https://github.com/spatie/laravel-ignition)           | Laravel error handling tool, providing better error pages and debugging information, suitable for debugging work in Laravel projects.                                                             |
| [laravel/breeze](https://github.com/laravel/breeze)                             | A package for quickly starting the basic authentication system of Laravel projects (such as login, registration, etc.), suitable for simple authentication functions.                             |
| [pestphp/pest](https://pestphp.com/)                                            | A modern and concise PHP testing framework that provides concise syntax and elegant testing functions, designed to replace PHPUnit.                                                               |
| [pestphp/pest-plugin-laravel](https://pestphp.com/)                             | A Laravel plug-in for Pest, integrating the features of the Laravel project, making Laravel testing more concise and meaningful.                                                                  |

## Features

- **User authentication and authorization**: Provides basic user login and permission authorization functions.

- **Distributed lock**: Distributed lock based on Redis to ensure resource security in a distributed environment.

- **Middleware support**: Built-in commonly used middleware, including authentication, request logs, cross-domain processing, etc.

- **Unified output format**: Provides a simple and easy-to-use API Result unified output method, standardizes the API response format, and improves interface consistency.

- **API modular design**: Supports modular API design, easy to expand and maintain.

- **Swagger document integration**: Automatically generates API documents for front-end development and testing.

## Structure

```
.
├── app/          # Core application code
├── bootstrap/    # Framework startup files
├── config/       # Configuration files
├── database/     # Database files
├── public/       # Web server root directory
├── resources/    # Resource files (views, language files, CSS, JS, etc.)
├── routes/       # Route definition files
├── storage/      # Framework-generated files (logs, cache, sessions, etc.)
├── tests/        # Automated test code
└── README.md     # Project documentation
```

## Run Local

```bash
# 1. Clone the project code base
git clone https://github.com/lniche/aphrodite-php.git
cd aphrodite-php

# 2. Configuration file
mv .env.example .env

# 3. Handle dependencies
# Make sure you have installed PHP and Laravel environment, Herd is recommended
composer install

# 4. Initialize the database
database/init.sql

# 5. Start the service
php artisan serve
```

## Repo Activity

![Alt](https://repobeats.axiom.co/api/embed/f148a33b1670c233b9fa96497ccdb22bd5b1077e.svg "Repobeats analytics image")

## Contribution

If you have any suggestions or ideas, please create an issue or submit a Pull Request directly.

1. **Fork** this repository.
2. **Create** a new branch:

```
git checkout -b feature/your-feature
```

3. **Commit** your changes:

```
git commit -m 'Add new feature'
```

4. **Push** to your branch:

```
git push origin feature/your-feature
```

5. **Submit** a Pull Request.

## License

This project is licensed under the MIT License.

## Acknowledgements

Special thanks to all contributors and supporters, your help is essential to us!
