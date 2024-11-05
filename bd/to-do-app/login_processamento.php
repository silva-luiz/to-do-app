<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once("database.php"); 
    require_once("jwt.php");

    $SQL = "SELECT id, password FROM user WHERE username = :username";
    $stmt = $conexao->prepare($SQL);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if (password_verify($password, $row['password'])) {
            
            $token = gerarJWT($row['id'], $username);
            

            setcookie('jwt', $token, time() + 3600, "/"); 
            header("Location: index.php"); 
            exit();
        } else {
            $erro = "Nome de usuário ou senha incorretos.";
        }
    } else {
        $erro = "Nome de usuário ou senha inválidos.";
    }
}

?>
