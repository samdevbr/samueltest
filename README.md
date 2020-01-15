Samuel Test REST API
===============

<img src="https://api.travis-ci.org/samdevbr/samueltest.svg?branch=master" alt="Build Status">

## Configuring Your Environment

This project uses [docker-compose](https://docs.docker.com/compose/) abstraction, you should have a fresh and configured installation of it's [latest version](https://docs.docker.com/compose/install).

After you've installed and configured docker-compose, in your terminal follow the below steps:

1. `git clone https://github.com/samdevbr/samueltest`
2. `cd samueltest`
3. `cd docker`
4. `docker-compose up -d`

>The commands above will clone and start the docker containers, you should wait for this proccess to finish before continuing.

## Configuring The Project

After your environment has been configured, we should configure the project it self, to do so follow below steps.

1. `docker-compose exec --user=php-user php-fpm bash`
2. `cp .env.example .env`
3. `composer install`
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed` *(this step isn't required)*

The above steps will connect to the container, install the dependencies and setup the MongoDB structure, the last step will insert some data, but it's no required.

## Done!

Now that you've configured your environement and the project, it should be working at http://localhost:8080
>The landpage for this address is the API Docs, feel free to play with it :)
