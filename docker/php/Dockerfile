FROM php:7.2-apache

RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

EXPOSE 80
