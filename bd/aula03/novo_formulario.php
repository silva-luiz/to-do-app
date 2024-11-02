<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo desse exercício é o de demonstrar
        como se conectar em um banco de dados e inserir um registro</p>

    <form method="POST" action="novo_processamento.php">
        Descrição:<br />
        <input type="text" id="descricao" name="descricao" size="50"/>

        <br /><br />

        Modelo:<br />
        <input type="text" id="modelo" name="modelo" size="50"/>

        <br /><br />
        
        Quantidade:<br />
        <input type="text" id="quantidade" name="quantidade" size="20"/>

        <br /><br />

        Valor:<br />
        <input type="text" id="valor" name="valor" size="20"/>

        <br /><br />

        <input type="submit" value="Cadastrar" />
        <input type="reset" value="Limpar" />
    </form>
</body>

</html>