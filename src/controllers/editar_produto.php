<?php
include_once '../controllers/banco.php';

$id = $_GET['id'];
$id_loja = $_GET['id_loja'];

// Log dos parâmetros recebidos
error_log("ID: $id, ID Loja: $id_loja");

// Consulta SQL para buscar o produto
$sql = "SELECT * FROM produtos WHERE id = :id AND id_loja = :id_loja";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':id_loja', $id_loja, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    error_log("Produto encontrado: " . print_r($result, true)); // Adicionado para depuração
    header('Content-Type: application/json');
    echo json_encode(['status' => true, 'produto' => $result]);
} else {
    // Log da falha na busca do produto
    error_log("Produto não encontrado para ID: $id, ID Loja: $id_loja");
    header('Content-Type: application/json');
    echo json_encode(['status' => false, 'msg' => 'Produto não encontrado.']);
}

$stmt->closeCursor();
$conn = null;