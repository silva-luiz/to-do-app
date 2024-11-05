<!DOCTYPE html>
<html>

<head>
    <title>TO-DO APP - Criar Usuário</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Cadastrar Usuário</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        session_start();
                        if (isset($_SESSION['status'])) {
                            echo '<div class="alert alert-success mt-3" role="alert">' . htmlspecialchars($_SESSION['status']) . '</div>';
                            unset($_SESSION['status']);
                        }
                        ?>

                        <form method="POST" action="novo_usuario_processamento.php">
                            <div class="form-group">
                                <label for="name" class="form-label font-weight-bold">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="form-label font-weight-bold">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Digite seu sobrenome" required>
                            </div>
                            <div class="form-group">
                                <label for="birthDate" class="form-label font-weight-bold">Data de Nascimento</label>
                                <input type="date" class="form-control" id="birthDate" name="birthDate" required>
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label font-weight-bold">Login</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu login" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label font-weight-bold">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                            <button type="button" class="btn btn-secondary btn-block" onclick="window.location.href='login.php'">Voltar</button>
                        </form>

                        <!-- Mensagem de status movida para baixo -->


                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
