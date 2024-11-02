<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo dessa tela é o de demonstrar em como inserir, alterar e excluir um registro</p>

    <?php
        //Incluindo o arquivo de conexão no banco de dados
        require_once("database.php");

        function insereRegistro($conexao, $descricao, $modelo, $quantidade, $valor)
        {
            $SQL = "INSERT INTO produtos (descricao, modelo, quantidade, valor) VALUES (:descricao, :modelo, :quantidade, :valor)";
            $statement = $conexao->prepare($SQL);
            $statement->bindValue(':descricao', $descricao);
            $statement->bindValue(':modelo', $modelo);
            $statement->bindValue(':quantidade', $quantidade);
            $statement->bindValue(':valor', $valor);
            return $statement->execute();
        }

        function atualizaRegistro($conexao, $codigo, $descricao, $modelo, $quantidade, $valor)
        {
            $SQL = "UPDATE produtos SET descricao = :descricao, modelo = :modelo, quantidade = :quantidade, valor = :valor WHERE codigo = :codigo";
            $statement = $conexao->prepare($SQL);
            $statement->bindValue(':codigo', $codigo);
            $statement->bindValue(':descricao', $descricao);
            $statement->bindValue(':modelo', $modelo);
            $statement->bindValue(':quantidade', $quantidade);
            $statement->bindValue(':valor', $valor);
            return $statement->execute();
        }    

        function removeRegistro($conexao, $codigo)
        {
            $SQL = "DELETE FROM produtos WHERE codigo = :codigo";
            $statement = $conexao->prepare($SQL);
            $statement->bindValue(':codigo', $codigo);
            return $statement->execute();
        }    
        
        // $retorno = insereRegistro($conexao, "Pepsi", "3 litros", "10", "9.52");
        // if ($retorno) {
        //     echo "Registro inserido com sucesso";
        // } else {
        //     echo "ERRO: O registro não foi inserido";
        // }
        
        // $retorno = atualizaRegistro($conexao, 7, "Sprite", "1 litro", "10", "1.99");
        // if ($retorno) {
        //     echo "Registro atualizado com sucesso";
        // } else {
        //     echo "ERRO: O registro não foi atualizado";
        // }

        // $retorno = removeRegistro($conexao, 7);
        // if ($retorno) {
        //     echo "Registro removido com sucesso";
        // } else {
        //     echo "ERRO: O registro não foi removido";
        // }

        //Fechando a conexão com o banco de dados
        // $conexao = null;
        unset($conexao);
    ?>

</body>

</html>