FROM php:8.3-cli-alpine

# Install dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    mysql-client \
    nodejs \
    npm \
    bash

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# Install PHP dependencies (without dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node & build assets
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Copy configs
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

CMD ["/usr/local/bin/entrypoint.sh"]