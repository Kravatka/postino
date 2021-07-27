FROM php:8.0-fpm

RUN touch uploads.ini
RUN echo "upload_max_filesize = 100M;" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "post_max_size = 100M;" >> /usr/local/etc/php/conf.d/uploads.ini

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install sockets

RUN apt-get update -y \
	&& apt-get install -y \
	sendmail \
	libpng-dev \
	libonig-dev \
	libzip-dev \
	libwebp-dev \
	libjpeg62-turbo-dev \
	libpng-dev \
	libxpm-dev \
	libfreetype6-dev \
	zlib1g-dev \
	libpq-dev \
	nano \
	git \
	libmcrypt-dev \
	curl \
	openssl

RUN docker-php-ext-install mbstring \
	zip \
	gd \
	pdo \
	pdo_pgsql \
	pdo_mysql \
	calendar \
	opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt install -y cron

# Copy hello-cron file to the cron.d directory
COPY crontab.txt /etc/cron.d/crontab.txt

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/crontab.txt

# Apply cron job
RUN crontab /etc/cron.d/crontab.txt

RUN apt-get install -y supervisor
COPY supervisord.conf /etc/supervisor/supervisord.conf

RUN mkdir /var/www/html/uploads
RUN chown -R www-data:www-data /var/www/html/uploads

ENV TZ=Europe/Kiev
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
