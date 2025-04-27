# Utilisation de l'image PHP avec Apache
FROM php:8.1-apache

# Installer les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql zip

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configuration d'Apache pour pointer vers le répertoire public de Laravel
RUN echo 'DocumentRoot /var/www/html/public' > /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Fixer les permissions des fichiers
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Activer mod_rewrite
RUN a2enmod rewrite

# Configuration du répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application Laravel dans l'image Docker
COPY . .

# Installer les dépendances de Composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]