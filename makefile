run:
	docker-compose up -d

up:
	docker-compose up

stop:
	docker-compose down

build:
	docker-compose build

pbuild:
	cd ./src && composer update && docker exec mag_php chown -R www-data:www-data /var/www/html/downloads

db_dump:
	docker exec db_container_name mysqldump [--user yourusername] [--password=yourpassword] databasename > /desired/path/to/db.dump

db_restore:
	docker exec -i db_container_name mysql [--user yourusername] [--password=yourpassword] databasename < /path/to/db.dump