# REST API for a Bolt with CRUD

## Basic installation steps 

Before you start the installation process you need to have **installed composer**

1. Clone the project
2. Navigate to the project root directory using command line
3. Run `composer install`
4. Copy `.env.example` into `.env` file
5. Adjust `DB_*` parameters.
6. Run `php artisan key:generate --ansi`
7. Run `php artisan migrate`

## How to get a Token

Access the application through your browser and create an accout, when redirected to your dashboard, create a new Token.

## API Route

```
{{Base_URL}}/api/server
```

Accepted method :
- GET
- POST
- PUT
- DELETE

Required parameter for `POST` :
- name

```
{{Base_URL}}/api/bolt
```

Accepted method :
- GET
- POST
- PUT
- DELETE

Required parameter for `POST` :
- name
- enabled
- server_id