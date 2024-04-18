<?php
include('auth_check.php');
include('../config.php');
session_start();

// Verifique se o usuário está logado e se é um administrador
// Esta verificação dependerá da sua implementação específica de controle de acesso

include('../inc/header.php');
?>

<h2>Painel Administrativo</h2>
<p>Bem-vindo ao painel administrativo do MoneyFive.</p>

<div>
    <h3>Operações</h3>
    <ul>
        <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
        <li><a href="gerenciar_solicitacoes.php">Gerenciar Solicitações de Consultoria</a></li>
        <li><a href="gerenciar_newsletter.php">Gerenciar Assinaturas da Newsletter</a></li>
    </ul>
</div>

<?php include('../inc/footer.php'); ?>
