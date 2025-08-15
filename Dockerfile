FROM php:8.2-apache

# Instala cURL e extensões necessárias
RUN apt-get update && apt-get install -y \
    curl \
    libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && docker-php-ext-enable curl

# Habilita mod_rewrite (URLs amigáveis)
RUN a2enmod rewrite

# Muda o DocumentRoot para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

# Define diretório de trabalho
# WORKDIR /var/www/html
WORKDIR /var/www/html/public

# Copia todo o projeto
COPY . /var/www/html

# Permissões para evitar problemas de escrita
RUN chown -R www-data:www-data /var/www/html
