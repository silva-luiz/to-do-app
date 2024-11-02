<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e inserir um registro</p>

    <?php
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $endDate = trim($_POST['endDate']);


    // Dados mockados
    // $descricao = "Sukita";
    // $modelo = "3 litros";
    // $quantidade = "999";
    // $valor = "0.99";
    
    if (($title == "") || ($description == "")) {
        echo "Há registros em branco!";
        return;
    }

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
    $SQL = "INSERT INTO activity " .
        "(title, description, endDate)" .
        " VALUES " .
        "(:title, :description, :endDate)";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':endDate', $endDate);
    if ($statement->execute()) {
        $status = "Registro inserido com sucesso";
    } else {
        $status = "Falha ao inserir o registro";
    }

    echo '{ "resposta": "$status" }';

    //Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br /><br />
    <a href="index.php">Listar registros</a>

</body>

</html>