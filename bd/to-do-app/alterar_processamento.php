<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Editar Tarefa</h2>

    <?php
    // Verificar se 'id', 'title' e 'description' estão definidos no $_POST
    $id = isset($_POST['id']) ? trim($_POST['id']) : null;
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    if ($id === null || $title == "" || $description == "") {
        echo "<div class='alert alert-danger'>Há registros em branco ou ID não foi fornecido!</div>";
        return;
    }

    // Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    // Definindo a query
    $SQL = "UPDATE activity SET title = :title, description = :description WHERE id = :id";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);

    if ($statement->execute()) {
        echo "<div class='alert alert-success'>Tarefa editada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Falha ao editar a tarefa!</div>";
    }

    // Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br />
    <a href="index.php" class="btn btn-primary">Voltar para Tarefas</a>

</body>

</html>