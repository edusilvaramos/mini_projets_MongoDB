
# Mini projets MongoDB -> Forum

A small  project using PHP, MongoDB and a minimal MVC structure.

## Requirements
- PHP 8.0+ (8.1+ recommended)
- MongoDB PHP extension (`pecl install mongodb`)
- Composer
- A MongoDB database (Atlas or local)

## Setup

Install dependencies

```bash
composer install
````

Configure environment
   Create a `.env` file in the project root:

pensar na connection: Atlas x Compass

```env
MONGODB_URI="mongodb+srv://<user>:<password>@<cluster>.mongodb.net/?appName=YourApp"
MONGODB_DB="yourDatabaseName"
```

 colocar as infos para o Run...

 colocar as infos para o uml...



## Notes

* Do **not** commit secrets. Keep `.env` out of version control.
* `vendor/` is generated from `composer.json`/`composer.lock` via `composer install`.

## License

For educational use only.

```
Resources: 

https://www.mongodb.com/pt-br/docs/php-library/current/get-started/
https://www.mongodb.com/pt-br/docs/php-library/current/connect/#std-label-php-connect
https://www.mongodb.com/docs/drivers/php-frameworks/symfony/#std-label-php-symfony-integration
https://www.youtube.com/watch?v=TXEZudz0s1E


taches: 

// criar o CRUD: 
   // user 
   // post 
   // comment
   // like. 
