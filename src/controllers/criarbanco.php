<?php

$dbPath = __DIR__ . '/banco.sqlite';

// Cria uma conexão PDO com o banco de dados SQLite
$conn = new PDO('sqlite:' . $dbPath);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $conn->exec("CREATE TABLE IF NOT EXISTS produtos (
        id INTEGER,
        setor TEXT,
        status_produto TEXT,
        nome_produto TEXT,
        embalagem TEXT,
        qtde_ideal INTEGER,
        data_ult_entr DATE,
        qtde_ult_entr INTEGER,
        estoque INTEGER,
        preco_custo REAL,
        preco_venda REAL,
        qtde_vendida INTEGER,
        tp_etiq TEXT
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
