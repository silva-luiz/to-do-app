<?php
    $v1 = $_GET["valor1"];
    $v2 = $_GET["valor2"];

    $operacao = $_GET["operacao"];

    $resultado = 0;

    if ($operacao == '+') {
        $resultado = $v1 + $v2;
    } else if ($operacao == '-') {
        $resultado = $v1 - $v2;
    } else if ($operacao == '*') {
        $resultado = $v1 * $v2;
    } else if ($operacao == '/') {
        $resultado = $v1 / $v2;
    }

    echo "Resultado = $resultado";
?>