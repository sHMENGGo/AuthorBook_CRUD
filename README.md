# Laravel Sample App

This project is a Laravel application using the default Laravel stack with Vite for the frontend styling. It is a basic author/book Create, Read, Update, Delete (CRUD) operations and uses SQLite by default for local development.

## Requirements

Before running the project locally, make sure you have the following installed:

- PHP 8.3 or newer
- Composer
- Node.js 20+ and npm
- A local terminal such as PowerShell, Git Bash, or the VS Code terminal

## Quick start

From the project root, run the following commands:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
```

If you want to reset the database and reseed it from scratch:

```powershell
php artisan migrate:fresh --seed
```

## Run the app locally

Start the Laravel server in one terminal:

```powershell
php artisan serve
```

Then start the Vite dev server in a second terminal:

```powershell
npm run dev
```

The application should be available at:

- http://localhost:8000

## Production build

To build front-end assets for deployment:

```powershell
npm run build
```

## Useful commands

Run database migrations:

```powershell
php artisan migrate
```

Seed the database:

```powershell
php artisan db:seed
```

Run tests:

```powershell
php artisan test
```

Lint PHP code:

```powershell
./vendor/bin/pint
```

Check static analysis:

```powershell
./vendor/bin/phpstan analyse
```

## Project notes

- The app is configured to use SQLite in the default `.env.example` file for quick local setup.
- `npm run dev` serves the frontend assets while `php artisan serve` runs the Laravel app.
- If the app was just cloned, make sure the database file and `.env` file exist before running migrations.

## Troubleshooting

If you get a missing environment variable or app key error, run:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

If the database is not initialized, run:

```powershell
php artisan migrate --seed
```

If frontend assets do not load, reinstall the Node dependencies:

```powershell
Remove-Item -Recurse -Force node_modules
npm install
npm run dev
```
