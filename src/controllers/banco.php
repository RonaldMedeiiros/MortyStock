<?php

require_once __DIR__ . '../../../vendor/autoload.php'; // Ajuste o caminho conforme necessário

// Se você estiver usando variáveis de ambiente para o caminho do banco de dados, certifique-se de que elas estão definidas
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../'); // Caminho para a raiz do projeto
$dotenv->load();

// Caminho para o arquivo do banco de dados SQLite
$dbPath = $_ENV['DB_PATH'] ?? __DIR__ . '/banco.sqlite'; // Ajuste o caminho conforme necessário

try {
    // Cria uma nova conexão PDO para o banco de dados SQLite
    $conn = new PDO('sqlite:' . $dbPath);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Você não precisa da linha MYSQL_ATTR_INIT_COMMAND para SQLite
    // $conn->exec("SET NAMES utf8");

    echo "Conexão com o banco de dados SQLite estabelecida com sucesso.";
} catch (PDOException $error) {
    echo "Erro ao conectar com o banco de dados SQLite: " . $error->getMessage();
}
