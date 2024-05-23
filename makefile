install:
	docker compose exec php composer install

db:
	docker compose exec php bin/console doctrine:migrations:migrate

currency-update:
	docker compose exec php bin/console app:currency:update