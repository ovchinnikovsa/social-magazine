run:
	docker-compose up -d

up:
	docker-compose up

stop:
	docker-compose down

build:
	docker-compose build

pbuild:
	cd ./src && composer update

pchown:
	docker-compose exec mag_php chown -R www-data:www-data /var/www/html/downloads

db_dump:
	docker-compose exec mag_mariadb sh -c "exec mariadb-dump -uroot -proot mydatabase > /var/backups/db.sql"

db_restore:
	docker-compose exec -i mag_mariadb sh -c "exec mysql --user=myuser --password=mypassword mydatabase < /var/backups/db.sql"

prod:
	docker-compose -f docker-compose-prod.yml up -d