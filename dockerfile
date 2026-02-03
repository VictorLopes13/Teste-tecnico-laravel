# Usando PHP + Apache
FROM php:8.2-apache

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip

# Habilitar mod_rewrite (Laravel precisa)
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar código
COPY . /var/www/html

# Definir diretório de trabalho
WORKDIR /var/www/html

# Rodar composer install
RUN composer install --no-dev --optimize-autoloader

# Chave Laravel
RUN php artisan key:generate

# Migrar banco (opcional: você pode fazer manual depois)
# RUN php artisan migrate --force

# Expor porta
EXPOSE 10000

# Start server
CMD php artisan serve --host=0.0.0.0 --port=10000
