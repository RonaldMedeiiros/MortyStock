<?php
require_once 'banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataCriacao = date('Y-m-d H:i:s');
    $senhaHash = md5($senha);

    // Inserir usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios_login (nome, email, senha, criado_em) VALUES (:nome, :email, :senha, :criado_em)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->bindParam(':criado_em', $dataCriacao);
    
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Erro ao cadastrar o usuário.";
    }
}
?>
