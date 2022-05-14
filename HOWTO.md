## Kanban board for Github issues

#### Requirements

* PHP 8.1
* Composer

#### Installation

* Clone repo
* Copy `.env.example` file to `.env` in the root of application
* Fill properly `.env` by the `.env.example` (You should fill all `.env` values)
* Install dependencies
```bash
$ composer install
```


#### Running the app

```bash
$ php -S localhost:3000 -t public/
```

#### Tests

```bash
$ ./vendor/bin/phpunit tests/
```


