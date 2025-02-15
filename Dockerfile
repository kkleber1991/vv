# syntax=docker/dockerfile:1

#######################################
# Etapa 1: Build dos assets com Node 20
#######################################
FROM node:20 AS node-build
WORKDIR /app

# Copia arquivos de dependências do Node e instala os pacotes
COPY package.json package-lock.json ./
RUN npm install

# Copia todo o código da aplicação e executa o build de produção
COPY . .
RUN npm run production

#######################################
# Etapa 2: Imagem final com PHP 8.3-FPM
#######################################
FROM php:8.3-fpm

# Instala dependências do sistema e a extensão pdo_sqlite
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Instala o Composer (usando a imagem oficial do Composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia os arquivos do Composer para aproveitar o cache e instala as dependências PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copia o restante do código da aplicação
COPY . .

# Substitui a pasta de assets pelo build realizado na etapa node-build
COPY --from=node-build /app/public ./public

# Cria o diretório e o arquivo do banco SQLite, se ainda não existirem
RUN mkdir -p database && touch database/database.sqlite

# Ajusta as permissões (caso necessário)
RUN chown -R www-data:www-data /var/www/html

# Expondo a porta 80 para o acesso à aplicação
EXPOSE 80

# Define variáveis de ambiente para produção
ENV APP_ENV=production
ENV APP_DEBUG=false

# Labels para integração com o Traefik (ajuste conforme sua configuração)
LABEL traefik.enable="true"
LABEL traefik.http.routers.laravel.rule="Host(example.com)"
LABEL traefik.http.routers.laravel.entrypoints="web"

# Copia o script de entrypoint para a imagem e garante que ele seja executável
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Define o entrypoint que cuidará de executar as migrations antes de iniciar o serviço
ENTRYPOINT ["entrypoint.sh"]

# Comando padrão: iniciar o PHP-FPM
CMD ["php-fpm"]
