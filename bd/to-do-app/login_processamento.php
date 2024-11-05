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

    // Verifica se o usuário foi encontrado
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if (password_verify($password, $row['password'])) {
            // Gerar token JWT após login
            $token = gerarJWT($row['id'], $username);
            setcookie('jwt', $token, time() + 3600, "/"); // Define o cookie para 1 hora
            header("Location: index.php"); // Redireciona para a página principal após o login
            exit();
        } else {
            $erro = "Nome de usuário ou senha incorretos.";
        }
    } else {
        $erro = "Nome de usuário ou senha inválidos.";
    }
}

?>
