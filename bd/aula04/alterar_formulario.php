<!DOCTYPE html>
<html>

<head>
    <title>TO-DO APP</title>
</head>

<body>

    <?php
    $id = $_GET['id'];

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
    $SQL = "SELECT * FROM activity WHERE id = $id";


    //Guarda a busca no array $resultado
    $resultado = $conexao->query($SQL);

    //Percorrendo todos os registros
    while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
        $id = $linha->id;
        $title = $linha->title;
        $description = $linha->description;
        $status = $linha->status;
    }

    ?>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e alterar um registro</p>

    <form method="POST" action="alterar_processamento.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        Nome da tarefa:<br />
        <input type="text" id="title" name="title" size="50" value="<?php echo $title; ?>" />

        <br />
        Descrição:<br />
        <input type="text" id="description" name="description" size="50" value="<?php echo $description; ?>" />

        <br /><br />

        <input type="submit" value="Salvar" />
        <input type="reset" value="Limpar" />
    </form>
</body>

</html>