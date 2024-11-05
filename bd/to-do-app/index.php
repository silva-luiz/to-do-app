<!DOCTYPE html>

<html>

<head>
    <title>TO-DO APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container mt-5">
    <?php
        require_once("database.php");
        require_once("jwt.php");
    if (isset($_COOKIE['jwt']) && validarJWT($_COOKIE['jwt'])) {
        $token = $_COOKIE['jwt'];
        $payload = decodificarJWT($token);
        $user_id = $payload['id'];
        $username = $payload['username'];
    } else {
        header("Location: login.php");
        exit();
    }
    ?>

    <h1>To-Do App</h1>
    <p class="mb-4">Olá, <?php echo htmlspecialchars($username); ?>! Gerencie suas tarefas.</p>
    <div class="text-end mb-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="modal fade" id="modalParticipantes" tabindex="-1" aria-labelledby="modalParticipantesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalParticipantesLabel">Participantes do Projeto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Carolina Medella</li>
                        <li class="list-group-item">Gabriela Gasch</li>
                        <li class="list-group-item">Jackson Santos</li>
                        <li class="list-group-item">Luiz Henrique Gomes</li>
                        <li class="list-group-item">Nicolas Duque</li>
                        <li class="list-group-item">Rafael Bazolli</li>
                    </ul>
                </div>
                <div class="modal-footer justify-content-center bg-secondary">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    if (isset($_COOKIE['jwt']) && validarJWT($_COOKIE['jwt'])) {
        $token = $_COOKIE['jwt'];
        $payload = decodificarJWT($token);
        $user_id = $payload['id'];
        $username = $payload['username'];
    } else {
        header("Location: login.php");
        exit();
    }

    // Definindo a query com parâmetro preparado
    $SQL = "SELECT * FROM activity WHERE user_id = :user_id";
    $stmt = $conexao->prepare($SQL);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Guardando o resultado da busca
    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Capturando a quantidade de registros
    $quantidade = count($resultado);

    if ($quantidade == 0) {
        echo "<div class='alert alert-warning'>Não há registros a serem exibidos</div>";
        echo "<a href='novo_formulario.php' class='btn btn-primary'>Adicionar tarefa</a>";
        return;
    }

    echo "<table class='table table-striped table-hover'>";
    echo "    <thead class='thead-dark'>";
    echo "        <tr>";
    echo "            <th>ID</th>";
    echo "            <th>Nome da Tarefa</th>";
    echo "            <th>Descrição</th>";
    echo "            <th>Data de Conclusão</th>";
    echo "            <th>Alterar</th>";
    echo "            <th>Remover</th>";
    echo "            <th>Concluir</th>";
    echo "            <th>Status</th>";
    echo "        </tr>";
    echo "    </thead>";
    echo "    <tbody>";

    // Percorrendo todos os registros
    foreach ($resultado as $linha) {
        // Verifica se a tarefa está concluída
        $classe = ($linha->status == 1) ? "table-success" : "";

        // Verifica se a data de conclusão foi ultrapassada e a tarefa não está concluída
        $dataAtual = date('Y-m-d');
        $endDateFormatada = date('Y-m-d', strtotime($linha->endDate));
        if ($linha->status == 0 && $endDateFormatada < $dataAtual) {
            $classe = "table-danger";
        }

        echo "<tr class='$classe'>";
        echo "<td>" . $linha->id . "</td>";
        echo "<td>" . $linha->title . "</td>";
        echo "<td>" . $linha->description . "</td>";
        echo "<td>" . date('d-m-Y', strtotime($linha->endDate)) . "</td>";
        echo "<td> <a href='alterar_formulario.php?id=" . $linha->id . "' class='btn btn-warning btn-sm'>Editar</a></td>";
        echo "<td> <a href='remover_processamento.php?id=" . $linha->id . "' class='btn btn-danger btn-sm'>Remover</a></td>";
        echo "<td> <a href='alterar_status.php?id=" . $linha->id . "' class='btn btn-success btn-sm'>Concluir</a></td>";
        echo "<td>" . ($linha->status == 1 ? "Concluída" : "Pendente") . "</td>";
        echo "</tr>";
    }

    echo "    </tbody>";
    echo "</table>";

    // Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br />
    <div class="d-flex justify-content-between">
        <a href="novo_formulario.php" class="btn btn-primary">Adicionar tarefa</a>

        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalParticipantes">
            Créditos
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>