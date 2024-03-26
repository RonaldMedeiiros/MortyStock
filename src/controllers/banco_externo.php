<?php

require_once __DIR__ . '../../../vendor/autoload.php'; // Ajuste o caminho conforme necessário

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../'); // Caminho para a raiz do projeto
$dotenv->load();

$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

try{
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $username, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
      ));
    }catch(PDOException $error){
        echo "Erro" . $error->getMessage();
}