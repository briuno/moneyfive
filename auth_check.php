<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Conecta ao banco de dados
include('config.php');

$id_usuario = $_SESSION['id_usuario'];

// Buscar informações do usuário
$sql = "SELECT nome, email, is_admin FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definições de acesso com base no papel do usuário
$adminAccessPages = ['dashboard.php', 'gerenciar_usuarios.php', 'gerenciar_solicitacoes.php', 'gerenciar_newsletter.php'];
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

// Verificar se a página atual requer acesso de administrador e se o usuário é administrador
if (in_array($currentPage, $adminAccessPages) && !$usuario['is_admin']) {
    header("Location: unauthorized.php");
    exit;
}

// Armazenar informações do usuário na sessão para uso posterior nas páginas
$_SESSION['user_name'] = $usuario['nome'];
$_SESSION['is_admin'] = $usuario['is_admin'];
?>
