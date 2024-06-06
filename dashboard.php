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
  <meta name="description" content="MoneyFive dashboards intuitivos">
  <meta name="keywords" content="MoneyFive, Money Five, Dashboards, Power BI, Consultoria">
  <meta name="author" content="MoneyFive">
  <link rel="shortcut icon" href="assets/Favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="css/dashboards.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />
  <title>Dashboards</title>
</head>

<body>
  <?php include('inc/header.php');?>
  <main class="dash__container">
    <section class="wrapper__title">
      <div class="wrapper__text">
        <h2 class="title">Dashboards</h2>
        <p class="subtitle">Bem-vindo de volta, <span><?php echo htmlspecialchars($usuario['nome']); ?>!</span></p>
      </div>
      <?php if((isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1)): ?>
      <a class="button" href="admin/dashboard.php">Painel Administrativo</a>
      <?php endif; ?>
    </section>

    <section class="dash__wrapper">
      <div class="dash__content">
        <iframe title="PBI ICY PARADISE" width="700" height="541.25"
          src="https://app.powerbi.com/reportEmbed?reportId=05a0f647-8bdb-4b56-9f9f-a306cfd49d84&autoAuth=true&ctid=6f9e3b1e-1809-444a-81d3-82d40a928812"
          frameborder="0" allowFullScreen="true"></iframe>

        <iframe title="PBI PI" width="700" height="541.25"
          src="https://app.powerbi.com/reportEmbed?reportId=05a0f647-8bdb-4b56-9f9f-a306cfd49d84&autoAuth=true&ctid=6f9e3b1e-1809-444a-81d3-82d40a928812"
          frameborder="0" allowFullScreen="true"></iframe>
      </div>

      <div class="dash__content">
        <iframe title="PBI FINANCIAL TRACKER" width="700" height="541.25"
          src="https://app.powerbi.com/view?r=eyJrIjoiZTA0M2FiZGMtNDYwNC00ZmJiLWIwOTMtODgyNzc5ZDEwNmM3IiwidCI6Ijc0MzBjOGJlLWQ1ZTMtNDgxYi1hNTcwLTZjOGI0MzRkZGY4OCIsImMiOjZ9"
          frameborder="0" allowFullScreen="true"></iframe>

        <iframe title="PBI ANALYTICS TRACKER" width="700" height="541.25"
          src="https://app.powerbi.com/view?r=eyJrIjoiYjc5ZTlhZmMtYjQ5ZC00MWU4LWEyMzAtZWVjNTllODZlOTc5IiwidCI6Ijc0MzBjOGJlLWQ1ZTMtNDgxYi1hNTcwLTZjOGI0MzRkZGY4OCIsImMiOjZ9"
          frameborder="0" allowFullScreen="true"></iframe>
      </div>
    </section>
  </main>
  <?php include('inc/footer.php'); ?>
</body>

</html>