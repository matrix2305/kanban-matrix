#!/bin/bash

docker exec -it kanban-api-app php artisan doctrine:schema:create &&
docker exec -it kanban-api-app php artisan kanban:seed