<?php

if (isset($_COOKIE['jwt'])) {
    setcookie('jwt', '', time() - 3600, "/");
}

$erro = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once("database.php"); 
    require_once("jwt.php");

    $SQL = "SELECT id, password, name FROM user WHERE username = :username";
    $stmt = $conexao->prepare($SQL);
    $stmt->bindParam(':username', $username);
    $stmt->execute();


    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if (password_verify($password, $row['password'])) {
            // Gerar token 
            $token = gerarJWT($row['id'], $username, $row['name']);
            setcookie('jwt', $token, time() + 3600, "/");
            header("Location: index.php"); 
            
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <div id="status-message"></div>
                        <form id="loginForm">
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

    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(e) {
                e.preventDefault()

                var formData = $(this).serialize();

                $.ajax({
                    url: 'login_processamento.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json', 
                    success: function(response) {
                        if (response.success) {
                            $('#status-message').html('<div class="alert alert-success mt-3">' + response.message + '</div>');
                            setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 1000);
                        } else {
                            $('#status-message').html('<div class="alert alert-danger mt-3">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#status-message').html('<div class="alert alert-danger mt-3">Erro ao processar a solicitação. Tente novamente.</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>

