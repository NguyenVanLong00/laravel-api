FROM php:8.2-fpm as php-app
COPY . /usr/src/api
WORKDIR /usr/src/api

COPY --from=composer /usr/bin/composer /usr/bin/composer

# RUN apt-get update && apt-get install -y vim

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
        p7zip \
        p7zip-full \
        unace \
        zip \
        unzip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

ENV PORT 8080

ENTRYPOINT ["./Docker/entrypoint.sh"]
