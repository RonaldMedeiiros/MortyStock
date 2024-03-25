<?php
require_once 'banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaHash = md5($senha);

    // Verificar as credenciais no banco de dados
    $stmt = $conn->prepare("SELECT * FROM USUARIOS WHERE EMAIL = :email AND SENHA = :senha");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Login bem-sucedido
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: pagina.php');
        exit();
    } else {
        // Login falhou
        header('Location: index.php');
        exit();
    }
}
?>
