<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e inserir um registro</p>

    <?php
    $descricao = trim($_POST['descricao']);
    $modelo = trim($_POST['modelo']);
    $quantidade = trim($_POST['quantidade']);
    $valor = trim($_POST['valor']);

    // Dados mockados
    // $descricao = "Sukita";
    // $modelo = "3 litros";
    // $quantidade = "999";
    // $valor = "0.99";

    if (($descricao == "") || ($modelo == "") || ($quantidade == "") || ($valor == "")) {
        echo "Há registros em branco!";
        return;
    }

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
    $SQL = "INSERT INTO produtos " .
        "(descricao, modelo, quantidade, valor)" .
        " VALUES " .
        "(:descricao, :modelo, :quantidade, :valor)";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':descricao', $descricao);
    $statement->bindParam(':modelo', $modelo);
    $statement->bindParam(':quantidade', $quantidade);
    $statement->bindParam(':valor', $valor);
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