<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="loginForm">
        <img class="loginLogo" src="arquivos/Logo 3.png" alt="">
            <h2>Login</h2>
            <form action="processa_login.php" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Entrar</button><br>
                <button><a href="cadastro.php" class="link">Criar uma conta</a></button>
            </form>
        </div>
    </div>
</body>
</html>
