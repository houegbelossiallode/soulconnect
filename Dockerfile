FROM php:8.2-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libsodium-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip pdo pdo_pgsql gd sodium

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copier le projet
COPY . .

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer dépendances frontend
RUN npm install
RUN npm run build

# Permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Lancer migrations + serveur
CMD sh -c "php artisan migrate --force && php -S 0.0.0.0:10000 -t public"
