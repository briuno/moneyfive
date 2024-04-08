<?php
session_start();

// Destruir todas as variáveis da sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login
header("Location: login.php");
exit;
?>
