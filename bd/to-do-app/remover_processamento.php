<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <h2 class="mb-4">Remover Registro</h2>
    <p>O objetivo desse exercício é demonstrar como se conectar a um banco de dados e remover um registro.</p>

    <?php
    $id = trim($_GET['id']);

    if ($id == "") {
        echo "<div class='alert alert-danger'>Código não encontrado!</div>";
        return;
    }

    require_once("database.php");

    $SQL = "DELETE FROM activity WHERE id = :id";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
        echo "<div class='alert alert-success'>Registro removido com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Falha ao remover o registro!</div>";
    }

    unset($conexao);
    ?>

    <br />
    <a href="index.php" class="btn btn-primary">Listar registros</a>

</body>

</html>