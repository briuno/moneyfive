<?php
// Definições de conexão com o banco de dados
if (!defined('DB_HOST')) {
    define('DB_HOST', '193.203.175.33');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'u153423140_moneyfive');
}

if (!defined('DB_USER')) {
    define('DB_USER', 'u153423140_moneyfive');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', 'Br220809#');
}

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Não foi possível conectar ao banco de dados: " . $e->getMessage());
}
?>
