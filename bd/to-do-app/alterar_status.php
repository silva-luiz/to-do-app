<?php

require_once("database.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $SQL = "SELECT status FROM activity WHERE id = :id";
  $statement = $conexao->prepare($SQL);
  $statement->bindParam(':id', $id);
  $statement->execute();
  $tarefa = $statement->fetch(PDO::FETCH_OBJ);

  if (!$tarefa) {
    echo "Tarefa não encontrada.";
    echo "<br /><a href='index.php'>Voltar</a>";
    return;
  }

  $novoStatus = $tarefa->status == 1 ? 0 : 1;

  $SQL = "UPDATE activity SET status = :status WHERE id = :id";
  $statement = $conexao->prepare($SQL);
  $statement->bindParam(':status', $novoStatus);
  $statement->bindParam(':id', $id);

  if ($statement->execute()) {
    echo "Status da tarefa alterado com sucesso.";
  } else {
    echo "Falha ao alterar o status.";
  }

  header("Location: index.php");
  exit();
} else {
  echo "ID da tarefa não fornecido.";
  echo "<br /><a href='index.php'>Voltar</a>";
}

unset($conexao);
?>