<?php

$dbPath = __DIR__ . '/banco.sqlite';

// Cria uma conexão PDO com o banco de dados SQLite
$conn = new PDO('sqlite:' . $dbPath);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $conn->exec("DELETE FROM produtos WHERE id = 'id'");
    echo "Tabela 'usuarios' atualizada com sucesso!\n";
;

    echo "Tabela 'USUARIOS' criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar as tabelas: " . $e->getMessage();
}
