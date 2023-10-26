#!/bin/bash

docker exec -it kanban-api-app php artisan doctrine:schema:create --force &&
docker exec -it kanban-api-app php artisan kanban:seed