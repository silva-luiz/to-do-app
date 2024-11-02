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

        function insereRegistro($conexao, $title, $description, $status, $endDate)
        {
            $SQL = "INSERT INTO activity (title, description, status, endDate) VALUES (:title, :description, :status, :endDate)";
            $statement = $conexao->prepare($SQL);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':status', $status);
            $statement->bindValue(':endDate', $endDate);
            return $statement->execute();
        }

        function atualizaRegistro($conexao, $codigo, $title, $description, $status, $endDate)
        {
            $SQL = "UPDATE activity SET title = :title, description = :description, status = :status, endDate = :endDate WHERE codigo = :codigo";
            $statement = $conexao->prepare($SQL);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':status', $status);
            $statement->bindValue(':endDate', $endDate);
            return $statement->execute();
        }    

        function removeRegistro($conexao, $codigo)
        {
            $SQL = "DELETE FROM activity WHERE codigo = :codigo";
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