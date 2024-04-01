<?php
include_once '../controllers/banco.php';

$dados_requisicao = $_REQUEST;

//lista de colunas na tabela
$colunas = [
    0 => 'id',
    1 => 'nome_produto',
    2 => 'setor',
    3 => 'estoque',
    4 => 'preco_venda',
    5 => 'qtde_ideal'
];

// Obtendo a quantidade de ids no banco
$query_qtd_produtos = "SELECT COUNT(id) AS qtd_produtos FROM produtos";

if(!empty($dados_requisicao['search']['value'])){
    $query_qtd_produtos .= " WHERE id LIKE :id ";
    $query_qtd_produtos .= " OR nome_produto LIKE :nome_produto ";
    $query_qtd_produtos .= " OR setor LIKE :setor ";
    $query_qtd_produtos .= " OR estoque LIKE :estoque ";
    $query_qtd_produtos .= " OR preco_venda LIKE :preco_venda ";
    $query_qtd_produtos .= " OR qtde_ideal LIKE :qtde_ideal ";
}
//preparar a query
$result_qtd_produtos = $conn->prepare($query_qtd_produtos);
if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] ."%";
    $result_qtd_produtos->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':nome_produto', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':setor', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':estoque', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':preco_venda', $valor_pesq, PDO::PARAM_STR);
    $result_qtd_produtos->bindParam(':qtde_ideal', $valor_pesq, PDO::PARAM_STR);
}
$result_qtd_produtos->execute();
$row_qtd_produtos = $result_qtd_produtos->fetch(PDO::FETCH_ASSOC);

// Recuperando os registros do banco
$query_produtos = " SELECT * FROM produtos ";

// acessa o if quando há parâmetros .. 
if(!empty($dados_requisicao['search']['value'])){
    $query_produtos .= " WHERE id LIKE :id ";
    $query_produtos .= " OR nome_produto LIKE :nome_produto ";
    $query_produtos .= " OR setor LIKE :setor ";
    $query_produtos .= " OR estoque LIKE :estoque ";
    $query_produtos .= " OR preco_venda LIKE :preco_venda ";
    $query_produtos .= " OR qtde_ideal LIKE :qtde_ideal ";
}

$query_produtos .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " .
    $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_produtos = $conn->prepare($query_produtos);
$result_produtos->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_produtos->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] ."%";
    $result_produtos->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':nome_produto', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':setor', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':estoque', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':preco_venda', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':qtde_ideal', $valor_pesq, PDO::PARAM_STR);
}
$result_produtos->execute();

while ($row_produtos = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    extract($row_produtos);
    $registro = [];
    $registro[] = $id;
    $registro[] = $nome_produto;
    $registro[] = $setor;
    $registro[] = $estoque;
    $registro[] = $preco_venda;
    $registro[] = $qtde_ideal;
    $dados_produtos[] = $registro;
}

// Criando o obj de informações a serem retornadas pelo JS
$resultado = [
    "draw" => intval($dados_requisicao['draw']), //para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($row_qtd_produtos['qtd_produtos']), //qtd de registros que há na tabela
    "recordsFiltered" => intval($row_qtd_produtos['qtd_produtos']),
    "data" => $dados_produtos,
];

//retornando os dados em forma de Json
echo json_encode($resultado);