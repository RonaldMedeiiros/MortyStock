<?php
include_once '../controllers/banco.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$id_loja = filter_input(INPUT_GET, 'id_loja', FILTER_SANITIZE_NUMBER_INT);
if ($id && $id_loja) {
    try {
        $query = "SELECT * FROM produtos WHERE id = :id AND id_loja = :id_loja";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_loja', $id_loja, PDO::PARAM_INT);
        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['status' => true, 'produto' => $produto]);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Produto não encontrado.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => false, 'msg' => 'Erro no servidor: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => false, 'msg' => 'Parâmetros inválidos.']);
}