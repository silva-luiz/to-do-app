<!DOCTYPE html>
<html>

<head>
    <title>TO-DO APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <?php
    $id = $_GET['id'];

    // Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    // Definindo a query
    $SQL = "SELECT * FROM activity WHERE id = $id";

    // Guardando a busca no array $resultado
    $resultado = $conexao->query($SQL);

    // Percorrendo todos os registros
    while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
        $id = $linha->id;
        $title = $linha->title;
        $description = $linha->description;
        $status = $linha->status;
    }
    ?>

    <h2 class="mb-4">Editar Tarefa</h2>
    <p class="mb-4">Aqui você pode editar suas tarefas.</p>

    <form method="POST" action="alterar_processamento.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <div class="mb-3">
            <label for="title" class="form-label">Nome da tarefa:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <input type="text" id="description" name="description" class="form-control"
                value="<?php echo $description; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-secondary">Limpar</button>
    </form>

</body>

</html>