<?php
include('../auth_check.php');
include('../config.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario']) || $_SESSION['is_admin'] != 1) {
  header('Location: ../dashboard.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
  <title>Painel Administrativo</title>
</head>

<body>
  <?php include('../inc/adminHeader.php'); ?>
  <article class="admin__container">
    <div class="wrapper__title">
      <div class="wrapper__text">
        <h2 class="title">Painel Administrativo</h2>
        <p class="subtitle">Bem-vindo ao painel administrativo.</p>
      </div>
      <?php if(($_SESSION['is_admin'] === 1)): ?>
        <a class="button" href="../dashboard.php">Painel Usuário</a>
      <?php endif; ?>
    </div>
    <div class="admin__wrapper">
      <h1 class="">Operações</h1>
      <div class="buttons__wrapper">
        <a class="button" href="gerenciar_usuarios.php">Gerenciar Usuários</a>
        <a class="button" href="gerenciar_solicitacoes.php">Gerenciar Solicitações de Consultoria</a>
        <a class="button" href="gerenciar_newsletter.php">Gerenciar Assinaturas da Newsletter</a>
      </div>
    </div>
  </article>
  <?php include('../inc/adminFooter.php'); ?>
</body>

</html>