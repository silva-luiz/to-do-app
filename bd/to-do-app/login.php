<?php
session_start();

if (isset($_COOKIE['jwt'])) {
    setcookie('jwt', '', time() - 3600, "/"); // Remove o cookie definindo um tempo de expiração no passado
}

$erro = ""; // Inicializa a variável de erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once("database.php"); 
    require_once("jwt.php");

    $SQL = "SELECT id, password FROM user WHERE username = :username";
    $stmt = $conexao->prepare($SQL);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Verifica se o usuário foi encontrado
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if (password_verify($password, $row['password'])) {
            // Gerar token JWT após login
            $token = gerarJWT($row['id'], $username);
            setcookie('jwt', $token, time() + 3600, "/"); // Define o cookie para 1 hora
            header("Location: index.php"); // Redireciona para a página principal após o login
            
            exit();
        } else {
            $erro = "Nome de usuário ou senha incorretos.";
        }
    } else {
        $erro = "Nome de usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($erro): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($erro) ?>
                            </div>
                        <?php endif; ?>
                        <form id="loginForm" method="POST" action="">
                            <div class="form-group">
                                <label for="username" class="form-label font-weight-bold">Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu usuário" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label font-weight-bold">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <button type="button" class="btn btn-secondary btn-block" onclick="window.location.href='criar_usuario.php'">Criar Usuário</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
