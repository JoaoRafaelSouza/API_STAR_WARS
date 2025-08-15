FROM php:8.2-apache

# Instala pacotes necessários para compilar extensões
RUN apt-get update && apt-get install -y \
    unzip nano git zip libzip-dev libcurl4-openssl-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli soap \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Muda o DocumentRoot para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf && \
    sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Define diretório de trabalho
WORKDIR /var/www/html/public

# Copia todo o projeto
COPY . /var/www/html

# Permissões para evitar problemas de escrita
RUN chown -R www-data:www-data /var/www/html
