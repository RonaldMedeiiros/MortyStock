<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/src/assets/css/login.css">
</head>
<body>
    <div class="container">
        
        <div class="loginForm">
        <img class="loginLogo" src="/src/assets/logos/Logo 3.png" alt="">
            <h2>Cadastro</h2>
            <form action="/src/controllers/processa_cadastro.php" method="post">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Cadastrar</button><br>
                <button><a href="/src/views/login.php" class="link">Voltar ao Login</a></button>
            </form>
        </div>
    </div>
</body>
</html>
