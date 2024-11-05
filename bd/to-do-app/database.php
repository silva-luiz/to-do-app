<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "to_do_app";

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit();
}
?>