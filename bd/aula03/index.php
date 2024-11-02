<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
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
        echo "Não há registros a serem exibidos";
        return;
    }

    echo "<table border = 1>";
    echo "	<tr>";
    echo "		<td>Código</td>";
    echo "		<td>Descrição</td>";
    echo "		<td>Modelo</td>";
    echo "		<td>Quantidade</td>";
    echo "		<td>Valor</td>";
    echo "		<td>Total</td>";
    echo "		<td>Alterar</td>";
    echo "		<td>Remover</td>";
    echo "	</tr>";

    //Percorrendo todos os registros
    while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
        echo "<tr>";
        //Imprime o elemento do array utilizando como chave o nome da coluna
        echo "<td>" . $linha->codigo . "</td>";
        echo "<td>" . $linha->descricao . "</td>";
        echo "<td>" . $linha->modelo . "</td>";
        echo "<td>" . $linha->quantidade . "</td>";
        echo "<td>" . number_format($linha->valor, 2) . "</td>";
        echo "<td>" . number_format($linha->quantidade * $linha->valor, 2) . "</td>";
        echo "<td> <a href='alterar_formulario.php?codigo=" . $linha->codigo . "'>Link</a></td>";
        echo "<td> <a href='remover_processamento.php?codigo=" . $linha->codigo . "'>Link</a></td>";

        echo "</tr>";
    }

    echo "</table>";

    //Fechando a conexão com o banco de dados
    // $conexao = null;
    unset($conexao);
    ?>

    <br />
    <a href="novo_formulario.php">Novo registro</a>

</body>

</html>