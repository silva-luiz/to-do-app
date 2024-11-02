<?php
    // validar se os valores valor1 e valor2 vieram preenchidos

    if (!isset($_POST["valor1"])) {
        echo "Valor 1 não encontrado.";
        return;
    }

    if (!isset($_POST["valor2"])) {
        echo "Valor 2 não encontrado.";
        return;
    }

    // validar se o valor da operacao veio preenchido

    if (!isset($_POST["operacao"])) {
        echo "Operacao não encontrado.";
        return;
    }

    // validar se estes valores são números

    if (!is_numeric($_POST["valor1"])) {
        echo "Valor 1 invalido.";
        return;
    }

    if (!is_numeric($_POST["valor2"])) {
        echo "Valor 2 invalido.";
        return;
    }
    
    // validar se o valor da operacao é suportado pela nossa aplicação

    if ($_POST["operacao"] != '+' &&
        $_POST["operacao"] != '-' &&
        $_POST["operacao"] != '*' &&
        $_POST["operacao"] != '/') {
        echo "Operacao invalida.";
        return;
    }

    if ($_POST["valor2"] == '0' && $_POST["operacao"] == '/') {
        echo "Divisao por zero não é permitida.";
        return;
    }

    $v1 = $_POST["valor1"];
    $v2 = $_POST["valor2"];
    $operacao = $_POST["operacao"];

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