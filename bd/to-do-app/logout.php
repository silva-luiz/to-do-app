<?php
session_start();

// Limpa o cookie do JWT
setcookie('jwt', '', time() - 3600, '/'); // Define o cookie para expirar

// Redireciona para a página de login
header("Location: login.php");
exit();
?>
