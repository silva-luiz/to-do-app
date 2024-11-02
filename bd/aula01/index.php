<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados, executar uma query, retornar os dados e exibir os mesmos</p>

    <?php

    //Informações da conexão
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "to_do_app";

    //Conectando no servidor do banco de dados
    //mysqli_connect: Abre uma conexão com um servidor MySQL
    $conexao = mysqli_connect($servidor, $usuario, $senha)
        or die("Servidor MySQL indisponível");

    //Selecionando o banco de dados
    //mysqli_select_db: Seleciona um banco de dados MySQL
    mysqli_select_db($conexao, $banco)
        or die("Banco de dados indisponível");

    //Definindo a query
    $SQL = "SELECT * FROM produtos";

    //Guarda a busca no array $resultado
    //mysqli_query: Envia uma consulta MySQL
    $resultado = mysqli_query($conexao, $SQL);

    //Capturando a quantidade de registros
    $quantidade = mysqli_num_rows($resultado);

    if ($quantidade == 0) {
        echo "Não há registros a serem exibidos";
        return;
    }

    echo "<table border = 1>";
    echo "	<tr>";
    echo "		<td>Atividade</td>";
    echo "		<td>Descrição</td>";
    echo "		<td>Status</td>";
    echo "		<td>Data de Conclusão</td>";
    echo "	</tr>";

    //mysqli_fetch_array: Obtém uma linha como uma matriz associativa, uma matriz numérica ou ambas
    while ($linha = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        //Imprime o elemento do array utilizando como chave o nome da coluna
        echo "<td>" . $linha['atividade'] . "</td>";

        //Imprime o elemento do array utilizando como chave o índice do array
        echo "<td> $linha[1] </td>";

        echo "<td> " . $linha['status'] . "</td>";

        echo "<td> " . $linha['conclusao'] . "</td>";

        echo "</tr>";
    }

    echo "</table>";

    //Linha de demonstração: 
    //print_r: Imprime informação sobre uma variável de forma legível
    print_r($linha);
    ?>

</body>

</html>