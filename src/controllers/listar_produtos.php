<?php
include_once '../controllers/banco.php';

$dados_requisicao = $_REQUEST;

//lista de colunas na tabela
$colunas = [
    0 => 'id',
    1 => 'id_loja',
    2 => 'nome_produto',
    3 => 'departamento',
    4 => 'setor',
    5 => 'estoque',
    6 => 'classe',
    7 => 'data_ult_entr',
    8 => 'sistema_entrega'
];

$query_qtd_produtos = "SELECT COUNT(id) AS qtd_produtos FROM produtos";

if(!empty($dados_requisicao['search']['value'])){
    $query_qtd_produtos .= " WHERE id LIKE :id ";
    $query_qtd_produtos .= " OR id_loja LIKE :id_loja ";
    $query_qtd_produtos .= " OR nome_produto LIKE :nome_produto ";    
    $query_qtd_produtos .= " OR departamento LIKE :departamento ";
    $query_qtd_produtos .= " OR setor LIKE :setor ";
    $query_qtd_produtos .= " OR estoque LIKE :estoque ";
    $query_qtd_produtos .= " OR classe LIKE :classe ";
    $query_qtd_produtos .= " OR data_ult_entr LIKE :data_ult_entr ";
    $query_qtd_produtos .= " OR sistema_entrega LIKE :sistema_entrega ";
}

$result_qtd_produtos = $conn->prepare($query_qtd_produtos);
if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] ."%";
    $result_qtd_produtos->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':id_loja', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':nome_produto', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':departamento', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':setor', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':estoque', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':classe', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':data_ult_entr', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':sistema_entrega', $valor_pesq, PDO::PARAM_STR);
}
$result_qtd_produtos->execute();
$row_qtd_produtos = $result_qtd_produtos->fetch(PDO::FETCH_ASSOC);


$query_produtos = " SELECT * FROM produtos ";


if(!empty($dados_requisicao['search']['value'])){
    $query_produtos .= " WHERE id LIKE :id ";
    $query_produtos .= " OR id_loja LIKE :id_loja ";
    $query_produtos .= " OR nome_produto LIKE :nome_produto ";    
    $query_produtos .= " OR departamento LIKE :departamento ";
    $query_produtos .= " OR setor LIKE :setor ";
    $query_produtos .= " OR estoque LIKE :estoque ";
    $query_produtos .= " OR classe LIKE :classe ";
    $query_produtos .= " OR data_ult_entr LIKE :data_ult_entr ";
    $query_produtos .= " OR sistema_entrega LIKE :sistema_entrega ";
}

$query_produtos .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " .
    $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_produtos = $conn->prepare($query_produtos);
$result_produtos->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_produtos->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] ."%";
    $result_produtos->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':id_loja', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':nome_produto', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':departamento', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':setor', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':estoque', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':classe', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':data_ult_entr', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':sistema_entrega', $valor_pesq, PDO::PARAM_STR);
}
$result_produtos->execute();

while ($row_produtos = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    extract($row_produtos);
    $registro = [];
    $registro[] = $id;
    $registro[] = $id_loja;
    $registro[] = $nome_produto;
    $registro[] = $departamento;
    $registro[] = $setor;
    $registro[] = $estoque;
    $registro[] = $classe;
    $registro[] = $data_ult_entr;
    $registro[] = $sistema_entrega;
    $registro[] = '<div style="display: flex; align-items: center;">
                   <button class="btn btn-warning btn-sm btn-edit" style="color: white; background-color: #ffc107; border: none; border-radius: 4px; padding: 5px 10px; font-size: 0.9rem; margin-right: 5px;" data-id="' . $id . '" data-id_loja="' . $id_loja . '">
                       <i class="fas fa-edit"></i> Editar
                   </button>
                   <button class="btn btn-danger btn-sm btn-delete" style="color: white; background-color: #dc3545; border: none; border-radius: 4px; padding: 5px 10px; font-size: 0.9rem;" data-id="' . $id . '" data-id_loja="' . $id_loja . '">
                       <i class="fas fa-trash-alt"></i> Excluir
                   </button>
               </div>';
$dados_produtos[] = $registro;

}


$resultado = [
    "draw" => intval($dados_requisicao['draw']),
    "recordsTotal" => intval($row_qtd_produtos['qtd_produtos']),
    "recordsFiltered" => intval($row_qtd_produtos['qtd_produtos']),
    "data" => $dados_produtos,
];


echo json_encode($resultado);