# Restaurant Website

This is a restaurant Website that contains restaurant information and allows user to interact with the restaurant such as contact, view menu as well as place and pay for an order.

## Installation
1. Download the archive or clone the project using git
2. Create `.env` file from `.env.example` file and adjust database and mail parameters
3. Run `composer install`
4. Run `php manage.php runmigrations` to apply migrations 
5. Run `php manage.php createsuperuser` to create a super user
6. Go to the `public` folder
7. Start php server by running command `php -S 127.0.0.1:8080`
8. Open in the browser [http://127.0.0.1:8080](http://127.0.0.1:8080)

## Objectives

1. Menu
2. Contact
3. About/info
4. Highlights/offers
5. Orders
6. Payments
7. Comments

## Users

1. Visitor - Unauthenticated
2. Authenticated Diner
3. Staff
4. Administrator

## Technologies

The system IS built on WAMP stack with the following technologies

- Javascript
- PHP
- HTML,CSS

## Contributing Guide

To contribute to this project follow the steps below.

1. Fork this repository to your account.
2. clone the repository to your local machine.
3. Create a branch with the name of feature you want to add or a issue you want to fix.
4. Add the feature and push to github.
5. Create a pull request with the develop branch.