<?php

// Incluindo o arquivo de conexão no banco de dados
require_once("database.php");

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Buscando o status atual da tarefa
  $SQL = "SELECT status FROM activity WHERE id = :id";
  $statement = $conexao->prepare($SQL);
  $statement->bindParam(':id', $id);
  $statement->execute();
  $tarefa = $statement->fetch(PDO::FETCH_OBJ);

  // Se a tarefa não for encontrada, redireciona para a página de listagem
  if (!$tarefa) {
    echo "Tarefa não encontrada.";
    echo "<br /><a href='index.php'>Voltar</a>";
    return;
  }

  // Alternando o status: 0 = Pendente, 1 = Concluída
  $novoStatus = $tarefa->status == 1 ? 0 : 1;

  // Atualizando o status no banco de dados
  $SQL = "UPDATE activity SET status = :status WHERE id = :id";
  $statement = $conexao->prepare($SQL);
  $statement->bindParam(':status', $novoStatus);
  $statement->bindParam(':id', $id);

  if ($statement->execute()) {
    echo "Status da tarefa alterado com sucesso.";
  } else {
    echo "Falha ao alterar o status.";
  }

  // Redireciona para a página de listagem
  header("Location: index.php");
  exit();
} else {
  echo "ID da tarefa não fornecido.";
  echo "<br /><a href='index.php'>Voltar</a>";
}

// Fechando a conexão com o banco de dados
unset($conexao);
?>