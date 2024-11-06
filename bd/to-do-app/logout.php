<?php

// Limpa o cookie
setcookie('jwt', '', time() - 3600, '/');

header("Location: login.php");
exit();
?>
