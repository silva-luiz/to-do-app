<?php

header('Content-Type: application/json');

$id = isset($_POST['id']) ? trim($_POST['id']) : null;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

if ($id === null || $title == "" || $description == "") {
    echo json_encode([
        'success' => false,
        'message' => 'Há registros em branco ou o ID não foi fornecido!'
    ]);
    exit;
}

require_once("database.php");

$SQL = "UPDATE activity SET title = :title, description = :description WHERE id = :id";

$statement = $conexao->prepare($SQL);
$statement->bindParam(':id', $id);
$statement->bindParam(':title', $title);
$statement->bindParam(':description', $description);

if ($statement->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Tarefa editada com sucesso!'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Falha ao editar a tarefa!'
    ]);
}

unset($conexao);
?>
