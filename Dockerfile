FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer mod_rewrite
RUN a2enmod rewrite

# Ajouter ServerName pour éviter l'erreur
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


# Configurer Apache pour autoriser .htaccess
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/custom-rewrite.conf \
    && a2enconf custom-rewrite


# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]


