<!DOCTYPE html>
<html>

<head>
    <title>TO-DO APP - Editar Tarefa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Editar Tarefa</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $id = $_GET['id'];

                        // Incluindo o arquivo de conexão no banco de dados
                        require_once("database.php");

                        // Definindo a query
                        $SQL = "SELECT * FROM activity WHERE id = $id";

                        // Guardando a busca no array $resultado
                        $resultado = $conexao->query($SQL);

                        // Percorrendo todos os registros
                        while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
                            $id = $linha->id;
                            $title = $linha->title;
                            $description = $linha->description;
                            $status = $linha->status;
                        }
                        ?>

                        <form method="POST" action="alterar_processamento.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />

                            <div class="mb-3">
                                <label for="title" class="form-label font-weight-bold">Nome da Tarefa:</label>
                                <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label font-weight-bold">Descrição:</label>
                                <input type="text" id="description" name="description" class="form-control"
                                    value="<?php echo $description; ?>" required>
                            </div>

                            <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary col-5">Salvar</button>
        <button type="reset" class="btn btn-secondary col-5">Limpar</button>
    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
