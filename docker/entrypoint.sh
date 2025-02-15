#!/bin/sh
# Entrypoint para inicializar a aplicação Laravel

# Verifica se o arquivo do banco SQLite existe; se não, cria-o.
if [ ! -f database/database.sqlite ]; then
    echo "Criando o arquivo do banco SQLite..."
    touch database/database.sqlite
fi

# Executa as migrations para atualizar o banco de dados
echo "Executando migrations..."
php artisan migrate --force

# Executa o comando que foi passado (por padrão, inicia o PHP-FPM)
exec "$@"
