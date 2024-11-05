<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>
    <?php
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $endDate = trim($_POST['endDate']);

    
    if (($title == "") || ($description == "")) {
        echo "Há registros em branco!";
        return;
    }

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    // Validando maior ID atual
    $query = "SELECT MAX(id) AS max_id FROM activity";
    $result = $conexao->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $id = $row['max_id'] + 1;

    //Definindo a query
    $SQL = "INSERT INTO activity " .
        "(id, title, description, endDate)" .
        " VALUES " .
        "(:id, :title, :description, :endDate)";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':id', $id);
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