<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e inserir um registro</p>

    <?php

    $id = trim($_POST['id']);
    $description = trim($_POST['description']);


    // Dados mockados
    // $id = "14";
    
    if (($id == "") || ($description == "")) {
        echo "Há registros em branco!";
        return;
    }

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
    $SQL = "UPDATE activity " .
        "SET title = :title, description = :description" .
        " WHERE id = :id ";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':description', $description);

    if ($statement->execute()) {
        echo "Registro alterado com sucesso";
    } else {
        echo "Falha ao alterar o registro";
    }

    //Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br /><br />
    <a href="index.php">Listar registros</a>

</body>

</html>