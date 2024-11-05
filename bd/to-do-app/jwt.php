<?php

function gerarJWT($id, $username) {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode(['id' => $id, 'username' => $username, 'exp' => time() + 3600]); // Validade 1h

    $headerBase64 = base64_encode($header);
    $payloadBase64 = base64_encode($payload);
    $assinatura = hash_hmac('sha256', $headerBase64 . "." . $payloadBase64, '9v6R3@sd!FQxq%7&hW8pLmZ2#H5jKsP@u
', true);
    $assinaturaBase64 = base64_encode($assinatura);

    return $headerBase64 . "." . $payloadBase64 . "." . $assinaturaBase64;
}

function validarJWT($token) {
    list($header, $payload, $assinatura) = explode('.', $token);
    $base64Payload = base64_decode($payload);
    $payloadArray = json_decode($base64Payload, true);

    if ($payloadArray['exp'] < time()) {
        return false;
    }

    // Verificar a assinatura
    $validacao = hash_hmac('sha256', $header . "." . $payload, '9v6R3@sd!FQxq%7&hW8pLmZ2#H5jKsP@u
', true);
    $validacaoBase64 = base64_encode($validacao);

    return $validacaoBase64 === $assinatura;
}

function decodificarJWT($token) {
    $partes = explode('.', $token);
    if (count($partes) !== 3) {
        return null; // Token inválido
    }
    
    $payloadBase64 = $partes[1];
    $payloadJson = base64_decode($payloadBase64);
    $payload = json_decode($payloadJson, true);
    
    return $payload;
}

?>
