#!/bin/sh

composer validate

composer install --no-interaction --prefer-dist

php ./vendor/bin/phpinsights -v --no-interaction

php ./vendor/bin/phpstan analyse --ansi --memory-limit 512M

php ./vendor/bin/psalm

php -d error_reporting='E_ALL ^ E_DEPRECATED' -d session.use_cookies=false -d session.cache_limiter=false ./vendor/bin/pest --stop-on-failure --coverage

php --version
