FROM php:8.2-fpm
COPY . /usr/src/api
WORKDIR /usr/src/api

# RUN apt-get update && apt-get install -y vim

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

ENV PORT 8080

ENTRYPOINT ["./Docker/entrypoint.sh"]
