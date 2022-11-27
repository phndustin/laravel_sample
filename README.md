## Setup project

## Server Requirements

```bash
    - PHP >= 7.2.5
    - BCMath PHP Extension
    - Ctype PHP Extension
    - Fileinfo PHP extension
    - JSON PHP Extension
    - Mbstring PHP Extension
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
    - Node v12.x.x
    - npm v6.x.x
```

## Installation
### Backend
- Requirement: docker, docker-compose

```bash
# Link .env
ln -s .env.docker .env

# Update .env set WWWUSER=<user id in unix os>. Run command to get user id
id -u

# Build up docker
docker-compose up -d
# Check docker
docker ps

# After build up the docker, we can run composer/artisan in the docker env.
# Connect to api container before run the commands
docker exec -it api bash

## Next step ==================================================
# in your app directory
# Install dependency
composer install

# generate laravel APP_KEY
php artisan key:generate

# Update db
php artisan migrate:refresh --seed

# Make ekko disk accessible from the web
php artisan storage:link

```
