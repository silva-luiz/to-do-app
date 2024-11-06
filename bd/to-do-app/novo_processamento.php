<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
</head>

<body>
    <?php
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $endDate = trim($_POST['endDate']);

    
    if (($title == "") || ($description == "")) {
        echo json_encode(["resposta" => "Há registros em branco!"]);
        return;
    }

    require_once("database.php");
    require_once("jwt.php");

    if (isset($_COOKIE['jwt']) && validarJWT($_COOKIE['jwt'])) {
        $token = $_COOKIE['jwt'];
        $payload = decodificarJWT($token);
        $user_id = $payload['id'];
    } else {
        header("Location: login.php");
        exit();
    }

    // Validando maior ID atual
    $query = "SELECT MAX(id) AS max_id FROM activity";
    $result = $conexao->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $id = $row['max_id'] + 1;

    $SQL = "INSERT INTO activity (id, title, description, endDate, user_id) 
        VALUES (:id, :title, :description, :endDate, :user_id)";

    $statement = $conexao->prepare($SQL);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':endDate', $endDate);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($statement->execute()) {
        $status = "Registro inserido com sucesso";
    } else {
        $status = "Falha ao inserir o registro";
    }

    echo json_encode(["resposta" => $status]);

    unset($conexao);
    ?>

    <br /><br />
    <a href="index.php">Listar registros</a>

</body>

</html>