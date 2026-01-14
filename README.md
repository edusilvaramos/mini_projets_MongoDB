
# Mini projets MongoDB -> Forum

A small  project using PHP, MongoDB and a minimal MVC structure.

## Requirements
- PHP 8.0+ (8.1+ recommended)
- MongoDB PHP extension (`pecl install mongodb`)
- Composer
- A MongoDB database (MongoDB Atlas cloud or local MongoDB/Compass)

## Setup

### 1. Install dependencies

```bash
composer install
```

### 2. Configure environment

Copy the example environment file and configure your database:

```bash
cp .env.example .env
```

Then edit `.env` with your MongoDB connection details:

**For MongoDB Atlas (cloud):**
```env
MONGODB_URI=mongodb+srv://userName:password@cluster0.6spphmx.mongodb.net/?appName=YourApp
MONGODB_DB=dbname
```

**For local MongoDB (Compass):**
```env
MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DB=dbname
```

### 3. Run the application

Start the PHP built-in server:

```bash
php -S localhost:8000
```

Then open your browser at `http://localhost:8000`

## Project Structure

This project follows an MVC architecture:
- `src/Model/` - Data models (User, Post, Comment, Like)
- `src/Repository/` - Database access layer
- `src/Controller/` - Request handlers
- `src/Connection/` - MongoDB connection management
- `view/templates/` - HTML templates

## UML Diagram

A UML diagram of the project structure is available in [diagram.puml](diagram.puml). You can view it using PlantUML or any compatible viewer.



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
