<?php
include_once '../controllers/banco.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$id_loja = filter_input(INPUT_GET, 'id_loja', FILTER_SANITIZE_NUMBER_INT);

if ($id && $id_loja) {
    $query = "DELETE FROM produtos WHERE id = :id and id_loja = :id_loja";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':id_loja', $id_loja, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount()) {
        echo json_encode(['status' => true, 'msg' => 'Produto excluído com sucesso!']);
    } else {
        echo json_encode(['status' => false, 'msg' => 'Erro ao excluir o produto.']);
    }
} else {
    echo json_encode(['status' => false, 'msg' => 'ID inválido.']);
}
