# Recipes Backend

The frontend for this app can be found [here](https://github.com/Gadzev/recipes_frontend)

# Getting started

## Homestead Installation (recommended)

First install homestead. [Official Documentation](https://laravel.com/docs/5.6/homestead#installation-and-setup)

Clone the repository

    git clone https://github.com/Gadzev/recipes_backend.git

Switch to the repo folder

    cd recipes_backend

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Install homestead for this project

** Mac / Linux: **

    php vendor/bin/homestead make

** Windows: **

    vendor\\bin\\homestead make


```
Next, run the > vagrant up command in your terminal and access your project at  http://homestead.recipesapi in your browser. Remember, you will still need to add an /etc/hosts file entry for homestead.recipesapi or the domain of your choice.

```

** Make sure you have a mysql database under your homestead user **

## Create db

SSH into vagrant

    vagrant ssh

Login and create the db

    mysql -u homestead -psecret

    create database recipesdb;

Now exit the mysql and vagrant instance

    exit (twice)

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Generate passport keys

    php artisan passport:install

** Copy the client secret in the .env under PASSPORT_CLIENT_SECRET=(your secret here) **

Seed database

    php artisan db:seed

Access the api at http://homestead.recipesdb



## Local Installation 

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.6/installation#installation)


Clone the repository

    git clone https://github.com/Gadzev/recipes_backend.git

Switch to the repo folder

    cd recipes_backend

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Generate passport keys

    php artisan passport:install

** Copy the client secret in the .env under PASSPORT_CLIENT_SECRET=(your secret here) **

Seed database

    php artisan db:seed

** This seeds an example user with: username => 'temp@user.com' and password => 'temppass' **

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


## License

[MIT license](http://opensource.org/licenses/MIT)
