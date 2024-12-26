# Laravel Role Permission with Inertia V2
This repository provides a Laravel application that implements role-based permissions using Inertia.js with Vue 3. The application allows administrators to manage users, roles, and permissions within a web interface. It leverages Laravel's authorization features along with the Spatie Laravel-Permission package to enforce access control throughout the application.

Key features include:
- User management: create, edit, and delete users, and assign roles and permissions.
- Role management: define roles with specific permissions.
- Permission management: manage permissions that can be assigned to roles and users.
- Inertia.js for seamless single-page application experience.
- Vue 3 for modern, reactive UI components.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP >= 8.2.0
- Composer
- Node.js & npm
- MySQL or any other supported database

## Installation

### 1. Clone the repository

```
git clone https://github.com/developernajib/inertia-role-permission.git
```
```
cd inertia-role-permission
```

### 2. Install PHP dependencies
```
composer install
```
### 3. Install Node.js dependencies
```
npm install
```
### 4. Set up the environment file
Copy the .env.example file to .env and configure your environment variables:

```
cp .env.example .env
```
Update the .env file with your database and other necessary configurations.

### 5. Generate application key
```
php artisan key:generate
```
### 6. Run database migrations
```
php artisan migrate --seed
```
## Running the Project

### 1. Serve the Laravel application & Building assets
To serve the application locally and building assets, use:
```
composer run dev
```
This will start the server at http://localhost:8000

## Build the assets permanently

### 1. Building Vue.js Files for Production
To build the assets for vue files for production, run:
```
npm run prod
```
This command will compile and minify the Vue.js files for production use.


### 📜 Author

**Name:** Md. Najib Islam  
**Signature:** DeveloperNajib  
**Occupation:** Software Engineer  
**Contact:** [Telegram](https://t.me/developernajib)
