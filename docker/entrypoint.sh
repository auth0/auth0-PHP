#!/bin/sh

composer validate

composer install --no-interaction --prefer-dist

php ./vendor/bin/phpinsights -v --no-interaction

php ./vendor/bin/phpstan analyse --ansi --memory-limit 512M

php ./vendor/bin/psalm

php ./vendor/bin/pest --stop-on-failure --coverage

php --version
