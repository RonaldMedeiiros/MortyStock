<?php

$host = "208.109.21.134";
$username = "trabalho_metodologia";
$password = "tads2024@";
$dbname = "DB_MORTYSTOCK";

try{
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $username, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
      ));
    }catch(PDOException $error){
        echo "Erro" . $error->getMessage();
}