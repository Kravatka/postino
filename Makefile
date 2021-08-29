up: docker-compose up -d

down: docker-compose down

build: docker-compose up -d --build

# refresh:
# 	docker-compose exec php composer dump-autoload && \
# 	docker-compose exec php php artisan migrate:refresh && \
# 	docker-compose exec php php artisan db:seed -v

test:
	docker-compose exec php vendor/bin/phpunit --colors=always

perm:
	docker-compose exec php chmod 777 bootstrap/cache -R
	docker-compose exec php chmod 777 storage -R

cache-clear:
	docker-compose exec php php artisan cache:clear && \
	docker-compose exec php php artisan route:clear && \
	docker-compose exec php php artisan config:clear

default:
	grep -v '^#' Makefile

.DEFAULT_GOAL := default

composer-install:
	docker-compose exec php composer install
