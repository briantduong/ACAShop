#!/bin/sh

composer install --no-interaction;
composer update --no-interaction;
composer dump-autoload --optimize;
