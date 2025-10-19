FROM php:8.2-fpm

# Installer dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libsodium-dev && \
    docker-php-ext-install pdo pdo_pgsql sodium && \
    rm -rf /var/lib/apt/lists/*

# Copier Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Installer les dépendances Symfony
RUN composer install --no-interaction --no-progress

CMD ["php-fpm"]

