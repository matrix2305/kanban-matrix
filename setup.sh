#!/bin/bash

docker-compose -f ./docker-compose.staging.yml up -d &&
cp -rf ./server-app/api/.env.example ./server-app/api/.env &&
docker exec -it kanban-api-app composer update &&
docker exec -it kanban-api-app php artisan optimize &&
docker exec -it kanban-api-app php artisan l5-swagger:generate &&
sudo chmod -R 777 ./server-app/api/storage &&
sudo chown -R 777 ./server-app/api/storage &&
exit 0