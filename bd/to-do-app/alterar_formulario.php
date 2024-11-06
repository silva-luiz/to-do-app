<!DOCTYPE html>
<html>

<head>
    <title>TO-DO APP - Editar Tarefa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <style>
        #message {
            margin-top: 15px;
        }
    </style>

    <div class="container mt-5">
        <?php
        $id = $_GET['id'];

        require_once("database.php");

        $SQL = "SELECT * FROM activity WHERE id = $id";
        $resultado = $conexao->query($SQL);

        while ($linha = $resultado->fetch(PDO::FETCH_OBJ)) {
            $id = $linha->id;
            $title = $linha->title;
            $description = $linha->description;
            $status = $linha->status;
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Editar Tarefa</h4>
                    </div>
                    <div class="card-body">
                        <form id="editForm">
                            <input type="hidden" name="id" value="<?= $id; ?>" />
                            <div class="mb-3">
                                <label for="title" class="form-label font-weight-bold">Nome da Tarefa:</label>
                                <input type="text" id="title" name="title" class="form-control" value="<?= $title; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label font-weight-bold">Descrição:</label>
                                <input type="text" id="description" name="description" class="form-control" value="<?= $description; ?>" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary col-5">Salvar</button>
                                <button type="reset" class="btn btn-secondary col-5">Limpar</button>
                            </div>
                        </form>
                        <div id="message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                const formData = $(this).serialize();

                $.ajax({
                    url: 'alterar_processamento.php', 
                    type: 'POST', 
                    data: formData, 
                    dataType: 'json', 
                    success: function(response) {
                        const messageDiv = $('#message');
                        messageDiv.removeClass('alert-danger alert-success'); 

                        if (response.success) {
                            messageDiv.addClass('alert alert-success');
                            messageDiv.text(response.message);

                            setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 2000);
                        } else {
                            messageDiv.addClass('alert alert-danger');
                            messageDiv.text(response.message);
                        }
                    },

                    error: function(xhr, status, error) {
                        const messageDiv = $('#message');
                        messageDiv.removeClass('alert-danger alert-success');
                        messageDiv.addClass('alert alert-danger');
                        messageDiv.text('Erro ao processar a solicitação: ' + error);
                    }
                });
            });
        });
    </script>

</body>

</html>
