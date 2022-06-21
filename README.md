## About

A development test for dacxi with two endpoints:

-   [/api/price/{coin}].
-   [/api/estimated-price/{coin}].

## Requirements

-   PHP >= 8
-   composer

## Installation

Clone this project on your local enviroment

run

```bash
$ composer install
```

## Running the project

run

```bash
$ cp .env.example .env
$ php artisan key:generate
```

Then

```bash
$ php artisan sail:install
```

Choose a mysql option

then

```bash
$ ./vendor/bin/sail up
```

You have to run migrations file in another tab of your terminal

```bash
$ ./vendor/bin/sail artisan migrate
```

Access your http://localhost

You can access the endpoint by postman or your preferred API CLIENT

## Available endpoints

### You can use the following coins params: bitcoin, dacxi, ethereum and cosmos.

#### api/price/{coin}

```string
http://localhost/api/price/bitcoin
```

Will return and save the price and the coin on local database

#### api/estimated-price/{coin}

In this endpoint you need to inform the date and time parameters. You can use your API CLIENT's parameters tab.

```string
http://localhost/api/estimated-price/bitcoin
```

```json
{
    "date": "16-04-2017",
    "time": "22:07"
}
```
