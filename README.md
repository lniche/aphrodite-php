# Aphrodite Laravel API Scaffold

Aphrodite is a template project based on [Laravel API Scaffold](https://github.com/redot-src/laravel-api-scaffold), designed to help developers get started quickly and deeply understand the use process of the framework. The project provides comprehensive sample code and configuration, covering common development scenarios, to facilitate learning and practice. In addition, Aphrodite also includes container deployment templates, making the project easy to deploy and manage in modern cloud environments, helping developers to efficiently build and release applications.

## Tech Stack

| Technology                                                | Description                                                                                    |
| --------------------------------------------------------- | ---------------------------------------------------------------------------------------------- |
| [tokio](https://github.com/tokio-rs/tokio)                | Asynchronous runtime, supporting multiple asynchronous functions and full features             |
| [clap](https://github.com/clap-rs/clap)                   | Command line argument parsing library, supporting derivative macros                            |
| [thiserror](https://github.com/dtolnay/thiserror)         | Error handling library, providing concise error definitions                                    |
| [anyhow](https://github.com/dtolnay/anyhow)               | Flexible error handling library, suitable for simplifying error propagation                    |
| [base64](https://crates.io/crates/base64)                 | Base64 encoding and decoding library                                                           |
| [time](https://crates.io/crates/time)                     | Time processing library, supporting macros, local time zones, formatting and parsing functions |
| [serde](https://serde.rs/)                                | Data serialization and deserialization library, supporting derivative macros                   |
| [serde_json](https://crates.io/crates/serde_json)         | JSON data serialization and deserialization library                                            |
| [tracing](https://github.com/tokio-rs/tracing)            | Asynchronous application logging framework                                                     |
| [tracing-subscriber](https://github.com/tokio-rs/tracing) | Log subscriber, supporting JSON format                                                         |

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
