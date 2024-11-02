<?php    
    if (
        !isset($_POST["peso"]) ||
        !isset($_POST["altura"])
    ) {
        echo "{ resultado : 'Valores inválidos.' }";
        return;
    }

    $peso = $_POST["peso"];
    $altura = $_POST["altura"];

    $imc = $peso / ($altura * $altura);

    $diagnostico = '';

    if ($imc < 18.6) {
        $diagnostico = "Abaixo do peso.";
    } else if ($imc <= 24.9) {
        $diagnostico = "Peso ideal (parabéns).";
    } else if ($imc <= 29.9) {
        $diagnostico = "Levemente acima do peso.";
    } else if ($imc <= 34.9) {
        $diagnostico = "Obesidade grau I.";
    } else if ($imc <= 39.9) {
        $diagnostico = "Obesidade grau II (severa).";
    } else {
        $diagnostico = "Obesidade grau III (mórbida).";
    }

    // na requisição sincrona, a aplicação (fronent) depende da resposta do servidor 
    // ou seja, o usuário precisa aguardar um resposta para continuar utilizando a aplicação
    // sleep(10);

    //echo "Resultado IMC = " . round($imc, 2) . "<br>";
    //echo "Diagnóstico = " . $diagnostico . "<br>";

    header("Content-Type: application/json");
    echo '{ "resultado": "' . round($imc, 2) . '"  , "diagnostico": "' . $diagnostico . '" }';
?>
