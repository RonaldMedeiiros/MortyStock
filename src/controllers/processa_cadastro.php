<?php
require_once 'banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataCriacao = date('Y-m-d H:i:s');
    $senhaHash = md5($senha);

    // Inserir usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO USUARIOS (NOME, EMAIL, SENHA, DATA_CRIACAO) VALUES (:nome, :email, :senha, :criado_em)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->bindParam(':criado_em', $dataCriacao);
    
    if ($stmt->execute()) {
        header('Location: /src/views/login.php');
        exit();
    } else {
        echo "Erro ao cadastrar o usuário.";
    }
}
?>
