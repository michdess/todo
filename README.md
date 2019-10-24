# Todo
[![Build Status](https://travis-ci.org/michdess/todo.svg?branch=master)](https://travis-ci.org/michdess/todo)
[![StyleCI](https://github.styleci.io/repos/216146156/shield?branch=master)](https://github.styleci.io/repos/216146156)
[![Code Quality](https://scrutinizer-ci.com/g/michdess/todo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/michdess/todo/?branch=master)

Create a simple list of tasks to do.

## Installation:
* Git clone
* CD into directory
```
composer install
```
* Create .env file
```
cp .env.example .env
```
* Edit the .env file and add your database credentials (you will need to have made a database for the project to use)
* Generate the application key
```
php artisan key:generate
```
* migrate the database
```
php artisan migrate
```
* install node dependencies
```
npm install
```
* Compile Assets
```
npm run dev
```
* Register, Login and start using it

## Tests
The endpoints have been driven out using TDD and all tests can be found in the tests folder. They can be run using phpunit.