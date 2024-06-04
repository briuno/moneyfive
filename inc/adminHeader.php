<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="container">
  <nav class="wrapper" aria-label="Menu Principal">
    <a class="image" href="../index.php">
      <img src="../assets/logo.svg" alt="Logo da MoneyFive">
    </a>
    <ul>
      <li><a class="header__link" href="../admin/dashboard.php">Dashboard</a></li>
      <li><a class="header__link" href="../admin/gerenciar_usuarios.php">Gerenciar Usuários</a></li>
      <li><a class="header__link" href="../admin/gerenciar_solicitacoes.php">Gerenciar Solicitações de Consultoria</a>
      </li>
      <li><a class="header__link" href="../admin/gerenciar_newsletter.php">Gerenciar Assinaturas da Newsletter</a>
      </li>
    </ul>
    <?php if(isset($_SESSION['id_usuario'])): ?>
    <a class="button" href="../logout.php">Logout</a>
    <?php else: ?>
    <div class="header__buttons">
      <a class="button" href="../login.php">Login</a>
    </div>
    <?php endif; ?>
  </nav>
</header>