<!DOCTYPE html>

<html>

<head>
    <title>TO-DO APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="container mt-5">
    <h1>To-Do App</h1>
    <p class="mb-4">Gerencie suas tarefas.</p>

    <?php

    // Incluindo o arquivo de conexão no banco de dados
    require_once("database.php");

    // Definindo a query
    $SQL = "SELECT * FROM activity";

    // Guardando a busca no array $resultado
    $resultado = $conexao->query($SQL);

    // Capturando a quantidade de registros
    $quantidade = $resultado->rowCount();

    if ($quantidade == 0) {
        echo "<div class='alert alert-warning'>Não há registros a serem exibidos</div>";
        echo "<a href='novo_formulario.php' class='btn btn-primary'>Adicionar tarefa</a>";
        return;
    }

    echo "<table class='table table-striped table-hover'>";
    echo "	<thead class='thead-dark'>";
    echo "		<tr>";
    echo "			<th>ID</th>";
    echo "			<th>Nome da Tarefa</th>";
    echo "			<th>Descrição</th>";
    echo "			<th>Data de Conclusão</th>";
    echo "			<th>Alterar</th>";
    echo "			<th>Remover</th>";
    echo "			<th>Concluir</th>";
    echo "			<th>Status</th>";
    echo "		</tr>";
    echo "	</thead>";
    echo "	<tbody>";

    // Percorrendo todos os registros
    while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
        // Verifica se a tarefa está concluída e aplica a classe 'table-success' se for o caso
        $classe = ($linha->status == 1) ? "table-success" : "";

        echo "<tr class='$classe'>";
        // Imprime o elemento do array utilizando como chave o nome da coluna
        echo "<td>" . $linha->id . "</td>";
        echo "<td>" . $linha->title . "</td>";
        echo "<td>" . $linha->description . "</td>";
        echo "<td>" . $linha->endDate . "</td>";
        echo "<td> <a href='alterar_formulario.php?id=" . $linha->id . "' class='btn btn-warning btn-sm'>Editar</a></td>";
        echo "<td> <a href='remover_processamento.php?id=" . $linha->id . "' class='btn btn-danger btn-sm'>Remover</a></td>";
        echo "<td> <a href='alterar_status.php?id=" . $linha->id . "' class='btn btn-success btn-sm'>Concluir</a></td>";
        echo "<td>" . ($linha->status == 1 ? "Concluída" : "Pendente") . "</td>"; // Exemplo de status
        echo "</tr>";
    }

    echo "	</tbody>";
    echo "</table>";

    // Fechando a conexão com o banco de dados
    unset($conexao);
    ?>

    <br />
    <a href="novo_formulario.php" class="btn btn-primary">Adicionar tarefa</a>

</body>

</html>