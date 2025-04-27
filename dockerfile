# Utilisation d'une image officielle de PHP
FROM php:8.0-fpm

# Installer les dépendances système requises
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Installer Composer (gestionnaire de dépendances PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier tous les fichiers du projet dans le conteneur
COPY . .

# Exécuter Composer pour installer les dépendances du projet
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80 pour servir l'application
EXPOSE 80

# Lancer PHP-FPM (serveur web PHP)
CMD ["php-fpm"]