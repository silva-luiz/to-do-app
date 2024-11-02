<?php
    if (
        !isset($_POST["peso"]) ||
        !isset($_POST["altura"])
    ) {
        echo "Valores inválidos.";
        return;
    }

    $peso = $_POST["peso"];
    $altura = $_POST["altura"];

    $imc = $peso / ($altura * $altura);

    $resultado = '';

    if ($imc < 18.6) {
        $resultado = "Abaixo do peso.";
    } else if ($imc <= 24.9) {
        $resultado = "Peso ideal (parabéns).";
    } else if ($imc <= 29.9) {
        $resultado = "Levemente acima do peso.";
    } else if ($imc <= 34.9) {
        $resultado = "Obesidade grau I.";
    } else if ($imc <= 39.9) {
        $resultado = "Obesidade grau II (severa).";
    } else {
        $resultado = "Obesidade grau III (mórbida).";
    }

    // na requisição sincrona, a aplicação (fronent) depende da resposta do servidor 
    // ou seja, o usuário precisa aguardar um resposta para continuar utilizando a aplicação
    // sleep(10);

    echo "Resultado IMC = " . round($imc, 2) . "<br>";
    echo "Diagnóstico = " . $resultado . "<br>";

    echo '<a href="../frontend/view-calculadora-imc.html">Voltar</a>';
?>
