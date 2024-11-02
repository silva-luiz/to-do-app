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
    $linha = 0;

    if ($imc < 18.6) {
        $resultado = "Abaixo do peso.";
        $linha = 1;
    } else if ($imc <= 24.9) {
        $resultado = "Peso ideal (parabéns).";
        $linha = 2;
    } else if ($imc <= 29.9) {
        $resultado = "Levemente acima do peso.";
        $linha = 3;
    } else if ($imc <= 34.9) {
        $resultado = "Obesidade grau I.";
        $linha = 4;
    } else if ($imc <= 39.9) {
        $resultado = "Obesidade grau II (severa).";
        $linha = 5;
    } else {
        $resultado = "Obesidade grau III (mórbida).";
        $linha = 6;
    }

    $json_resposta = 
    "{ " . 
        "\"valor\": " . round($imc, 2) .
        ", \"avaliacao\": \"" . $resultado . 
        "\", \"linha\": \"" . $linha
    . "\"}";

    header("Content-Type: application/json");

    echo $json_resposta;

    /*
    $json_resposta = 
    '{ "' . 
        '"valor": ' . round($imc, 2) .
        '", "avaliacao": "' . $resultado 
    . '"}';
    */

    //echo "Resultado IMC = " . round($imc, 2) . "<br>";
    //echo "Diagnóstico = " . $resultado . "<br>";
?>
