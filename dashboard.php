<?php
include('config.php');
include('auth_check.php');
session_start();

$id_usuario = $_SESSION['id_usuario'];

// Buscar informações do usuário
$sql = "SELECT nome, email FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/dashboards.css" media="screen" />
  <title>Dashboards</title>
</head>

<body>
  <?php include('inc/header.php');?>
  <main class="dash__container">
    <section class="wrapper__title">
      <h2 class="title">Dashboards</h2>
      <p class="subtitle">Bem-vindo de volta, <span><?php echo htmlspecialchars($usuario['nome']); ?>!</span></p>
    </section>

    <section class="dash__wrapper">
    </section>
  </main>
  <?php include('inc/footer.php'); ?>
</body>

</html>
