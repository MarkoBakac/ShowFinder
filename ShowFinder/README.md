# ShowFinder JSON API

![Laravel Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

A JSON API built with Laravel for searching TV shows by name using a third-party service, TVMaze.

## Getting Started

These instructions will help you set up and run the project on your local machine for development and testing purposes.

### Prerequisites

- PHP 8.x
- Composer
- Laravel

### Installation

1. Clone the repository

2. Navigate to the project directory:

```
cd showfinder
```

3. Install dependencies

```
composer install
```

4. Configure your environment variables by copying the .env.example file to .env and updating it with your configuration.

5. Generate an application key:

```
php artisan key:generate
```

6. Run the development server:

```
php artisan serve
```

### Usage

To search for TV shows by name, make a GET request to the /api/search endpoint with the q parameter:

Example:

```
http://localhost:8000/api/search?q=deadwood
```

### Running tests

To run unit tests, use the following command:

```
php artisan test
```