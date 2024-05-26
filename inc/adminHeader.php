<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoneyFive</title>
  <link rel="stylesheet" type="text/css" href="../css/header.css" media="screen" />
</head>
<body>
  <?php session_start(); ?>
  <header class="container">
    <nav class="wrapper">
      <a class="image" href="../index.php">
        <img src="../assets/logo.svg" alt="logo">
      </a>
      <ul>
        <li><a class="header__link" href="dashboard.php">Home</a></li>
        <li><a class="header__link" href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
        <li><a class="header__link" href="gerenciar_solicitacoes.php">Gerenciar Solicitações de Consultoria</a></li>
        <li><a class="header__link" href="gerenciar_newsletter.php">Gerenciar Assinaturas da Newsletter</a></li>
      </ul>
      <?php if(isset($_SESSION['id_usuario'])): ?>
      <div class="button"><a class="header__link" href="../logout.php">Logout</a></div>
      <?php else: ?>
      <div class="header__buttons">
        <a class="button" href="../login.php">Login</a>
      </div>
      <?php endif; ?>
    </nav>
  </header>
</body>
</html>
