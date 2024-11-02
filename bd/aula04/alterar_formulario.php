<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <?php
    $codigo = $_GET['codigo'];

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
    $SQL = "SELECT * FROM produtos WHERE codigo = $codigo";

    //Guarda a busca no array $resultado
    $resultado = $conexao->query($SQL);
    
    //Percorrendo todos os registros
    while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
        $codigo = $linha->codigo;
        $descricao = $linha->descricao;
        $modelo = $linha->modelo;
        $quantidade = $linha->quantidade;
        $valor = $linha->valor;
    }

    ?>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e alterar um registro</p>

    <form method="POST" action="alterar_processamento.php">

        <!-- Código: -->
        <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>" />

        Descrição:<br />
        <input type="text" id="descricao" name="descricao" size="50" value="<?php echo $descricao; ?>" />

        <br /><br />

        Modelo:<br />
        <input type="text" id="modelo" name="modelo" size="50" value="<?php echo $modelo; ?>" />

        <br /><br />

        Quantidade:<br />
        <input type="text" id="quantidade" name="quantidade" size="20" value="<?php echo $quantidade; ?>"/>

        <br /><br />

        Valor:<br />
        <input type="text" id="valor" name="valor" size="20" value="<?php echo $valor; ?>"/>

        <br /><br />

        <input type="submit" value="Salvar" />
        <input type="reset" value="Limpar" />
    </form>
</body>

</html>