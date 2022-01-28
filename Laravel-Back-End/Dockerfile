FROM php:8.0.7-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    curl \
    git

RUN docker-php-ext-install zip

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# ADD ./php/www.conf /usr/local/etc/php-fpm.d/
# RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel
# RUN mkdir -p /var/www
# RUN chown laravel:laravel /var/www

# Install extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]





