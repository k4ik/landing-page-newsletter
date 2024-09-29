FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /var/lib/apt/lists/*

# Copia o código da aplicação
COPY . /var/www/html

# Copia o arquivo de configuração do Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilita o site
RUN a2ensite 000-default \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instala as dependências do Composer
RUN composer install --working-dir=/var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
