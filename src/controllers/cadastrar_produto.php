<?php

include_once '../controllers/banco.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['id'])){
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Código do Produto!</div>'];
}elseif (empty($dados['id_loja'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo ID Loja!</div>'];
} elseif (empty($dados['nome_produto'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Produto!</div>'];
} elseif (empty($dados['departamento'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Departamento!</div>'];
} elseif (empty($dados['setor'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Setor!</div>'];
} elseif (empty($dados['estoque'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Estoque!</div>'];
} elseif (empty($dados['classe'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Classe!</div>'];
} elseif (empty($dados['sistema_entrega'])) {
    $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Necessário preencher o campo Entrega!</div>'];
} else{
    $query_usuario = "INSERT INTO produtos (id, id_loja, nome_produto, departamento, setor, estoque, classe, sistema_entrega, data_ult_entr) VALUES (:id, :id_loja, :nome_produto, :departamento, :setor, :estoque, :classe, :sistema_entrega, DATE('now'))";
    $cadastro = $conn->prepare($query_usuario);
    $cadastro->bindParam(':id', $dados['id']);
    $cadastro->bindParam(':id_loja', $dados['id_loja']);
    $cadastro->bindParam(':nome_produto', $dados['nome_produto']);
    $cadastro->bindParam(':departamento', $dados['departamento']);
    $cadastro->bindParam(':setor', $dados['setor']);
    $cadastro->bindParam(':estoque', $dados['estoque']);
    $cadastro->bindParam(':classe', $dados['classe']);
    $cadastro->bindParam(':sistema_entrega', $dados['sistema_entrega']);
    $cadastro->execute();

    if ($cadastro->rowCount()) {
        $retorna = ['status' => true, 'msg' => '<div class="alert alert-success" role="alert">Produto cadastrado com sucesso!</div>'];
    } else {
        $retorna = ['status' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro ao cadastrar o produto!</div>'];
    }
}

header('Content-Type: application/json');
echo json_encode($retorna);
exit;
