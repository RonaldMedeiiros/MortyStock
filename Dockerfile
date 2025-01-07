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
ENV DB_PATH=/var/www/html/src/controllers/banco.sqlite

# Expor a porta 80 para o Apache
EXPOSE 80

# Iniciar o Apache no primeiro plano
CMD ["apache2-foreground"]

# Configurar o diretório raiz do Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
