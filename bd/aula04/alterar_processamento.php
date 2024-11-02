<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e inserir um registro</p>

    <?php

    // Verificar se 'id', 'title' e 'description' estão definidos no $_POST
    $id = isset($_POST['id']) ? trim($_POST['id']) : null;
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    if ($id === null || $title == "" || $description == "") {
        echo "Há registros em branco ou ID não foi fornecido!";
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
        echo "Registro alterado com sucesso";
    } else {
        echo "Falha ao alterar o registro";
    }

    // Fechando a conexão com o banco de dados
    unset($conexao);
    ?>


    <br /><br />
    <a href="index.php">Listar registros</a>

</body>

</html>