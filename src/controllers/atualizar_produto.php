<?php
include_once '../controllers/banco.php';

// Receber os dados enviados pelo AJAX
$dados = $_POST;

// Sanitização e validação dos dados recebidos
$id = filter_var($dados['id'], FILTER_SANITIZE_NUMBER_INT);
$id_loja = filter_var($dados['id_loja'], FILTER_SANITIZE_NUMBER_INT);
$nome_produto = filter_var($dados['nome_produto'], FILTER_SANITIZE_STRING);
$departamento = filter_var($dados['departamento'], FILTER_SANITIZE_STRING);
$setor = filter_var($dados['setor'], FILTER_SANITIZE_STRING);
$estoque = filter_var($dados['estoque'], FILTER_SANITIZE_NUMBER_INT);
$classe = filter_var($dados['classe'], FILTER_SANITIZE_STRING);
$sistema_entrega = filter_var($dados['sistema_entrega'], FILTER_SANITIZE_STRING);

if ($id && $id_loja) {
    // Atualização no banco de dados
    $query = "UPDATE produtos SET nome_produto = :nome_produto, departamento = :departamento, 
              setor = :setor, estoque = :estoque, classe = :classe, sistema_entrega = :sistema_entrega 
              WHERE id = :id AND id_loja = :id_loja";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':id_loja', $id_loja, PDO::PARAM_INT);
    $stmt->bindParam(':nome_produto', $nome_produto);
    $stmt->bindParam(':departamento', $departamento);
    $stmt->bindParam(':setor', $setor);
    $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
    $stmt->bindParam(':classe', $classe);
    $stmt->bindParam(':sistema_entrega', $sistema_entrega);

    if ($stmt->execute()) {
        echo json_encode(['status' => true, 'msg' => 'Produto atualizado com sucesso!']);
    } else {
        echo json_encode(['status' => false, 'msg' => 'Falha ao atualizar o produto.']);
    }
} else {
    echo json_encode(['status' => false, 'msg' => 'Dados inválidos.']);
}
?>