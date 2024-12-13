# Use uma imagem base do PHP com suporte a SQLite
FROM php:8.1-apache

# Instale extensões necessárias para SQLite e outras dependências
RUN docker-php-ext-install pdo pdo_sqlite

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure o diretório da aplicação
WORKDIR /var/www/html

# Copie os arquivos da aplicação para o container
COPY . .

# Instale as dependências do projeto
RUN composer install

# Configurar variáveis de ambiente
ENV DB_PATH=/var/www/html/banco.sqlite

# Expor a porta 5100
EXPOSE 5100

# Iniciar o servidor PHP embutido na porta 5100
CMD ["php", "-S", "0.0.0.0:5100"]
