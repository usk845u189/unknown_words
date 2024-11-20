#!/bin/bash

docker exec -it web-app php artisan config:clear
# docker exec web-app php artisan migrate:fresh --seed --database=test
docker exec web-app php artisan migrate --seed --database=test
docker exec -it web-app vendor/bin/phpunit