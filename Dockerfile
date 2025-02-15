# Estágio de build
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Estágio de produção
FROM php:8.3-fpm-alpine

# Instalação de dependências essenciais
RUN apk add --no-cache \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    sqlite-dev

# Instalação e configuração de extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        gd \
        zip \
        bcmath \
        opcache

# Instalação do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuração do diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .
COPY --from=node-builder /app/public/build ./public/build

# Configuração das permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Instalação das dependências do Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configuração do ambiente
ENV APP_ENV=production
ENV APP_DEBUG=false

# Criação do banco de dados SQLite
RUN touch database/database.sqlite \
    && chown www-data:www-data database/database.sqlite \
    && chmod 664 database/database.sqlite

# Configuração do Nginx
COPY --from=nginx:alpine /etc/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

# Labels para Traefik
LABEL traefik.enable=true
LABEL traefik.http.routers.laravel.rule="Host(seu-dominio.com)"
LABEL traefik.http.routers.laravel.entrypoints=web
LABEL traefik.http.services.laravel.loadbalancer.server.port=80

# Executar migrations e otimizações
RUN php artisan migrate --force \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expor porta
EXPOSE 80

# Comando para iniciar
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
