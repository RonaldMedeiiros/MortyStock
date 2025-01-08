# Use uma imagem base do PHP com suporte a Apache
FROM php:8.1-apache

# Atualizar pacotes e instalar dependências necessárias para Composer e SQLite
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_sqlite

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar o diretório da aplicação
WORKDIR /var/www/html

# Copiar os arquivos da aplicação para o container
COPY . .

# Instalar dependências do Composer
RUN composer install

# Configurar variáveis de ambiente
ENV DB_PATH=/var/www/html/banco.sqlite

# Expor a porta 5100
EXPOSE 5200

# Iniciar o servidor PHP embutido na porta 5100
CMD ["php", "-S", "0.0.0.0:5200"]
