# Laravel Auth Example (trimmed)

This repository is a trimmed Laravel application used for demonstrating an authentication flow (register, login, logout) implemented using a service layer, Form Requests and API Resources. It was used to drive tests and development exercises.


## Clone & setup

Clone the GitHub repository and set it up locally (PowerShell):

```powershell
# clone the repo
git clone https://github.com/alissar583/Laravel-Testing.git
cd Laravel-Testing

# install PHP deps and prepare environment
composer install
copy .env.example .env; php artisan key:generate

# create and migrate the database 
php artisan migrate

# (optional) install frontend deps and build
npm install
npm run build

# run the app
php artisan serve
```

## What's included

- Laravel 12 skeleton
- Auth controller and an `AuthService` implementing the business logic
- Form Requests for validation and API Resources for responses
- Sanctum-based token authentication for API endpoints

## Quick setup (development)

1. Install PHP dependencies:

```powershell
composer install
```

2. Copy env and generate app key:

```powershell
copy .env.example .env; php artisan key:generate
```

3. Create and migrate the database (SQLite example):

```powershell
php -r "file_exists('database/database.sqlite') || New-Item -ItemType File database\database.sqlite"
php artisan migrate
```

4. Install Node dependencies and build assets (optional for API-only work):

```powershell
npm install
npm run build
```

5. Run the app:

```powershell
php artisan serve
```

## API Endpoints (overview)

All API endpoints are prefixed with `/api`.

- POST /api/register
  - Request: name, email, password, password_confirmation
  - Response: 201, { message, user, token }
- POST /api/login
  - Request: email, password
  - Response: 200, { message, user, token }
- POST /api/logout
  - Requires Authorization: Bearer <token>
  - Response: 200, { message }

Tokens are issued as Sanctum personal access tokens and are returned in the response body.

## Tests

Tests live in `tests/`. To run tests locally:

```powershell
php artisan test
```