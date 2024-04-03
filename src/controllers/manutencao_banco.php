<?php

$dbPath = __DIR__ . '/banco.sqlite';

// Cria uma conexão PDO com o banco de dados SQLite
$conn = new PDO('sqlite:' . $dbPath);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $conn->exec("UPDATE produtos set sistema_entrega = 'Centro de Distribuição Secundário' WHERE sistema_entrega = 'distribution_center' ");
    echo "Tabela 'usuarios' atualizada com sucesso!\n";
;

    echo "Tabela 'USUARIOS' criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar as tabelas: " . $e->getMessage();
}
