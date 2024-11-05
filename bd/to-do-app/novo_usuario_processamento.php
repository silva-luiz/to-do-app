<?php
session_start(); // Inicie a sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $lastName = trim($_POST['lastName']);
    $birthDate = $_POST['birthDate'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    require_once("database.php"); // Ajuste o caminho conforme necessário
    require_once("jwt.php");

    // Hash da senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT MAX(id) AS id FROM user";
    $result = $conexao->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'] + 1;

    // Prepara a consulta para inserir o novo usuário
    $SQL = "INSERT INTO user (id, name, lastName, birthDate, username, password) VALUES (:id, :name, :lastName, :birthDate, :username, :password)";
    $stmt = $conexao->prepare($SQL);
    
    // Vincula os parâmetros
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':birthDate', $birthDate);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        $token = gerarJWT($id, $username);
        setcookie('jwt', $token, time() + 3600, "/");

        $status = "Usuário cadastrado com sucesso!";
    } else {
        $status = "Falha ao cadastrar usuário.";
    }

    // Redireciona de volta para a página de cadastro
    header("Location: criar_usuario.php"); 
    exit();

}

?>
