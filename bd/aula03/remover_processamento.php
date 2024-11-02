<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e remover um registro</p>

    <?php

    $codigo = trim($_GET['codigo']);

    // Dados mockados
    // $codigo = "14";

    if ($codigo == "") {
        echo "Código não encontrado!";
        return;
    }

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
	$SQL = "DELETE FROM activity " .
    " WHERE codigo = :codigo ";

	$statement = $conexao->prepare($SQL);
	$statement->bindParam(':codigo', $codigo);
	if ($statement->execute()){
        echo "Registro removido com sucesso";
    }
    else{
        echo "Falha ao remover o registro";
    }

    //Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br /><br />
    <a href="index.php">Listar registros</a>

</body>

</html>