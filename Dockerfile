# Use uma imagem base do PHP com suporte a Apache
FROM php:8.1-apache

# Atualizar pacotes e instalar dependências necessárias para Composer e SQLite
RUN apt-get update && apt-get install -y \
    apache2 \
    libapache2-mod-php \
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

# Configurar o diretório raiz do Apache para o local correto
RUN sed -ri -e 's!/var/www/html!/var/www/html!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurar permissões para o Apache acessar os arquivos corretamente
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar módulos necessários do Apache, como rewrite
RUN a2enmod rewrite

# Expor a porta 5010 para o Apache
EXPOSE 5010

# Configurar o Apache para ouvir na porta 5010
RUN sed -i 's/Listen 80/Listen 5010/' /etc/apache2/ports.conf

# Iniciar o Apache no primeiro plano
CMD ["apache2-foreground"]
