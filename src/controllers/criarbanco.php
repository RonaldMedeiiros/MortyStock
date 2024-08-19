<?php

$dbPath = __DIR__ . '/banco.sqlite';

$conn = new PDO('sqlite:' . $dbPath);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $conn->exec("CREATE TABLE IF NOT EXISTS produtos (
        id INTEGER,
        id_loja INTEGER,
        departamento TEXT,
        setor TEXT,
        sistema_entrega TEXT,
        classe TEXT,
        nome_produto TEXT,
        data_ult_entr DATE, 
        estoque INTEGER
    )");
    echo "Tabela 'PRODUTOS' criada com sucesso!\n";

    $conn->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        senha TEXT,
        data_criacao DATETIME
    )");

    echo "Tabela 'USUARIOS' criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar as tabelas: " . $e->getMessage();
}


// Para importar o arquivo CSV entra no caminho do banco, depois faz o import .. 
// sqlite3 nome_do_banco.sqlite
// .mode csv
// .separator ";"
// .import "C:/Users/ronal/Documents/smg13.csv" nome_da_tabela