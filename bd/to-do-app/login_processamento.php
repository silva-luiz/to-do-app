<?php
header('Content-Type: application/json');

require_once("database.php"); 
require_once("jwt.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $SQL = "SELECT id, password, name FROM user WHERE username = :username";
    $stmt = $conexao->prepare($SQL);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if (password_verify($password, $row['password'])) {
            
            $token = gerarJWT($row['id'], $username, $row['name']);
            setcookie('jwt', $token, time() + 3600, "/"); 
            echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso!']);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Nome de usuário ou senha incorretos.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Nome de usuário ou senha inválidos.']);
        exit();
    }
}

?>
