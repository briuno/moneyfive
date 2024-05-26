<?php
// Definições de conexão com o banco de dados
define('DB_HOST', '193.203.175.33');
define('DB_NAME', 'u153423140_moneyfive');
define('DB_USER', 'u153423140_moneyfive');
define('DB_PASSWORD', 'Br220809#');

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    // Definir o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Definir o charset para utf8mb4
    $pdo->exec("set names utf8mb4");
} catch (PDOException $e) {
    die("Não foi possível conectar ao banco de dados: " . $e->getMessage());
}

// Outras configurações globais podem ser adicionadas aqui
?>
