<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
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

<body>

    <h2>Adicionar nova atividade</h2>
    <p>Insira abaixo os dados da nova atividade</p>

    <!-- <form method="POST" action="novo_processamento.php">
        Descrição:<br />
        <input type="text" id="descricao" name="descricao" size="50" />

        <br /><br />

        Modelo:<br />
        <input type="text" id="modelo" name="modelo" size="50" />

        <br /><br />

        Quantidade:<br />
        <input type="text" id="quantidade" name="quantidade" size="20" />

        <br /><br />

        Valor:<br />
        <input type="text" id="valor" name="valor" size="20" />

        <br /><br />

        <input type="submit" value="Cadastrar" />
        <input type="reset" value="Limpar" />
    </form> -->
    <div class="container">
        <div class="row" style="height: 15%;"></div>
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
                <div class="card text-center">
                    <div class="card-header">
                        <b>Cadastrar nova tarefa</b>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Nome da Tarefa</span>
                                </div>
                                <input id="title" name="title" type="text" class="form-control"
                                    aria-label="Título da Tarefa" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Descrição</span>
                                </div>
                                <input id="description" name="description" type="text" class="form-control"
                                    aria-label="Descrição" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Data de
                                        conclusão</span>
                                </div>
                                <input id="enddate" name="enddate" type="date" class="form-control"
                                    aria-label="Descrição" aria-describedby="inputGroup-sizing-default" required>
                            </div>

                            <br>
                            <a href="#" id="cadastrar" class="btn btn-dark">Cadastrar</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row"></div>
    </div>

    <div id="mensagem" style="display:none; margin: 0 auto; width: 250px">Registro inserido com sucesso!</div>

    <script>
        $("#cadastrar").click(
            function () {
                $("#resultado").text("");
                var _title = $("#title").val();
                var _description = $("#description").val();
                var _endDate = $("#enddate").val();
                var _status = false;

                $.ajax({
                    method: "POST",
                    url: "novo_processamento.php",
                    data: {
                        title: _title,
                        description: _description,
                        endDate: _endDate,
                        status: _status,
                    }
                }).done(
                    function () {
                        // Exibe a mensagem de sucesso com efeito de fade-in
                        //$("#mensagem").fadeIn();

                        // Após 3 segundos, esconde a mensagem com efeito de fade-out
                        //setTimeout(function() {
                        //    $("#mensagem").fadeOut();
                        //}, 3000);

                        window.location.href = "index.php";
                    }
                );
            }
        );
    </script>
</body>

</html>