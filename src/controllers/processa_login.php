<?php
require_once 'banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaHash = md5($senha);

    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: /src/views/home.php');
        exit();
    } else {
        echo "Usuário inexistente";
        header('Location: /src/views/login.php');
        exit();
    }
}
?>
