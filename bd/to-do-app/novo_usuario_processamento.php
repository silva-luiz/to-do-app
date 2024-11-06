<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $lastName = trim($_POST['lastName']);
    $birthDate = $_POST['birthDate'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    require_once("database.php");
    require_once("jwt.php");

    // Hash da senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT MAX(id) AS id FROM user";
    $result = $conexao->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'] + 1;

    $SQL = "INSERT INTO user (id, name, lastName, birthDate, username, password) VALUES (:id, :name, :lastName, :birthDate, :username, :password)";
    $stmt = $conexao->prepare($SQL);
    

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':birthDate', $birthDate);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuário cadastrado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar o usuário.']);
    }
    exit();

}

?>
