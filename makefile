run:
	docker-compose up -d

up:
	docker-compose up

stop:
	docker-compose down

build:
	docker-compose build

certinit:
	docker compose run --rm  certbot certonly --webroot --webroot-path /var/www/html/ --dry-run -d ovchie.space

certrun:
	docker compose run --rm  certbot certonly --webroot --webroot-path /var/www/html/ -d ovchie.space