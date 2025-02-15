# syntax=docker/dockerfile:1

#################################
# Etapa 1: Build dos assets com Node 20
#################################
FROM node:20 AS build-assets
WORKDIR /app

# Copia os arquivos de dependências do Node e instala os pacotes
COPY package.json package-lock.json ./
RUN npm install

# Copia todo o código da aplicação e executa o build dos assets de produção
COPY . .
RUN npm run production

#################################
# Etapa 2: Imagem final com PHP 8.3-FPM
#################################
FROM php:8.3-fpm

# Instala dependências do sistema e a extensão PDO_SQLITE
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
 && docker-php-ext-install pdo pdo_sqlite

# Instala o Composer a partir da imagem oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia os arquivos de dependências PHP e instala as dependências com Composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copia o restante do código da aplicação
COPY . .

# Substitui a pasta de assets pelo build realizado na etapa anterior
COPY --from=build-assets /app/public ./public

# Cria o diretório e o arquivo do banco SQLite (se ainda não existirem) e ajusta as permissões
RUN mkdir -p database && touch database/database.sqlite && chown -R www-data:www-data /var/www/html

# Expondo a porta 80 para a aplicação em produção
EXPOSE 80

# Define variáveis de ambiente para produção
ENV APP_ENV=production
ENV APP_DEBUG=false

# Labels para integração com o Traefik (ajuste conforme sua configuração)
LABEL traefik.enable="true"
LABEL traefik.http.routers.laravel.rule="Host(example.com)"
LABEL traefik.http.routers.laravel.entrypoints="web"

# Copia o script de entrypoint e torna-o executável
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Define o entrypoint que cuidará de executar as migrations antes de iniciar o serviço
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Inicia o PHP-FPM usando a forma shell para CMD (evita problemas de parsing)
CMD php-fpm
