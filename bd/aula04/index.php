<!DOCTYPE html>

<html>

<head>
    <title>TO-DO APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados, executar uma query, retornar os dados e exibir os mesmos</p>

    <?php

    //Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    //Definindo a query
    $SQL = "SELECT * FROM activity";

    //Guarda a busca no array $resultado
    $resultado = $conexao->query($SQL);

    //Capturando a quantidade de registros
    $quantidade = $resultado->rowCount();

    if ($quantidade == 0) {
        echo "Não há registros a serem exibidos<br />";
        echo " <a href='novo_formulario.php'>Adicionar atividade</a>";
        return;
    }

    echo "<table border = 1>";
    echo "	<tr>";
    echo "		<td>ID</td>";
    echo "		<td>Nome da Tarefa</td>";
    echo "		<td>Descrição</td>";
    echo "		<td>Data de conclusão</td>";
    echo "		<td>Alterar</td>";
    echo "		<td>Remover</td>";
    echo "		<td>Concluir</td>";
    echo "	</tr>";

    //Percorrendo todos os registros
    while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
        echo "<tr>";
        //Imprime o elemento do array utilizando como chave o nome da coluna
        echo "<td>" . $linha->id . "</td>";
        echo "<td>" . $linha->title . "</td>";
        echo "<td>" . $linha->description . "</td>";
        echo "<td>" . $linha->endDate . "</td>";
        echo "<td> <a href='alterar_formulario.php?id=" . $linha->id . "'>Editar atividade</a></td>";
        echo "<td> <a href='remover_processamento.php?id=" . $linha->id . "'>Remover atividade</a></td>";
        echo "<td> <a href='remover_processamento.php?id=" . $linha->id . "'><i class='bi bi-check black'></i>aa</a></td>";

        echo "</tr>";
    }

    echo "</table>";

    //Fechando a conexão com o banco de dados
    // $conexao = null;
    unset($conexao);
    ?>

    <br />
    <a href="novo_formulario.php">Adicionar atividade</a>

</body>

</html>