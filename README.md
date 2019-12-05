# Dashboard Preview

![preview dashboard](https://raw.githubusercontent.com/ajikamaludin/spp-paud/master/public/preview.png)

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone https://github.com/ajikamaludin/spp-paud.git

Switch to the repo folder

    cd spp-paud

Install all the dependencies using composer

    composer install

Create database for this app, copy the example env file and make the required database configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

# Code overview

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------
# Default SuperUser

Default Email : [demo link](http://app01.ajikamaludin.id)

    admin@example.com 

Password : 

    password

# Author

:rocket: [Aji Kamaludin](https://github.com/ajikamaludin)

:rocket: [Arif Setyo Nugroho](https://github.com/arifsetyo21)
