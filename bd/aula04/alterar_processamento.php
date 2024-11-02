<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e inserir um registro</p>

    <?php

    $codigo = trim($_POST['codigo']);
    $descricao = trim($_POST['descricao']);
    $modelo = trim($_POST['modelo']);
    $quantidade = trim($_POST['quantidade']);
    $valor = trim($_POST['valor']);

    // Dados mockados
    // $codigo = "14";

    if (($codigo == "") || ($descricao == "") || ($modelo == "") || ($quantidade == "")|| ($valor == "")) {
        echo "Há registros em branco!";
        return;
    }

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
	$SQL = "UPDATE produtos " .
    "SET descricao = :descricao, modelo = :modelo, quantidade = :quantidade, valor = :valor" .
    " WHERE codigo = :codigo ";

	$statement = $conexao->prepare($SQL);
	$statement->bindParam(':codigo', $codigo);
	$statement->bindParam(':descricao', $descricao);
	$statement->bindParam(':modelo', $modelo);
	$statement->bindParam(':quantidade', $quantidade);
	$statement->bindParam(':valor', $valor);
	if ($statement->execute()){
        echo "Registro alterado com sucesso";
    }
    else{
        echo "Falha ao alterar o registro";
    }

    //Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br /><br />
    <a href="index.php">Listar registros</a>

</body>

</html>