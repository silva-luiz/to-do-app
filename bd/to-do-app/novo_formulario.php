<!DOCTYPE html>
<html>

<head>
    <title>TO-DO APP - Nova Tarefa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Cadastrar Nova Tarefa</h4>
                    </div>
                    <div class="card-body">
                        <form id="taskForm">
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Nome da Tarefa</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Digite o nome da tarefa" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="font-weight-bold">Descrição</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    placeholder="Digite a descrição" required>
                            </div>
                            <div class="form-group">
                                <label for="enddate" class="font-weight-bold">Data de Conclusão</label>
                                <input type="date" class="form-control" id="enddate" name="enddate" required>
                            </div>
                            <button type="button" id="cadastrar" class="btn btn-success btn-block">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mensagem" class="alert alert-success mt-3 text-center" style="display:none;">
        Tarefa inserida com sucesso!
    </div>

    <script>
        $("#cadastrar").click(function () {
            var _title = $("#title").val();
            var _description = $("#description").val();
            var _endDate = $("#enddate").val();
            var _status = false;

            var dataMinima = new Date('2000-01-01');
            var dataSelecionada = new Date(_endDate);

            if (dataSelecionada < dataMinima) {
                alert('A data deve ser superior a 01/01/2000');
                return;
            }

            $.ajax({
                method: "POST",
                url: "novo_processamento.php",
                data: {
                    title: _title,
                    description: _description,
                    endDate: _endDate,
                    status: _status,
                }
            }).done(function () {
                $("#mensagem").fadeIn();

                setTimeout(function () {
                    $("#mensagem").fadeOut();
                    window.location.href = "index.php";
                }, 2000);
                
            });
        });
    </script>

</body>

</html>