<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>

    <p>O objetivo dessa tela é o de demonstrar em como inserir, alterar e excluir um registro</p>

    <?php

    require_once("database.php");

    function insereRegistro($conexao, $id, $title, $description, $status, $endDate)
    {
        $SQL = "INSERT INTO activity (title, description, status, endDate) VALUES (:title, :description, :status, :endDate)";
        $statement = $conexao->prepare($SQL);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':endDate', $endDate);
        return $statement->execute();
    }

    function atualizaRegistro($conexao, $id, $title, $description, $status, $endDate)
    {
        $SQL = "UPDATE activity SET title = :title, description = :description, status = :status, endDate = :endDate WHERE id = :id";
        $statement = $conexao->prepare($SQL);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':endDate', $endDate);
        return $statement->execute();
    }

    function removeRegistro($conexao, $id)
    {
        $SQL = "DELETE FROM activity WHERE id = :id";
        $statement = $conexao->prepare($SQL);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
    
    unset($conexao);
    ?>

</body>

</html>