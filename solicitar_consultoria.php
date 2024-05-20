<?php
include('config.php');
include('auth_check.php');
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Tratar o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $id_usuario = $_SESSION['id_usuario'];

    // Inserir a solicitação no banco de dados
    $sql = "INSERT INTO SolicitacoesConsultoria (id_usuario, descricao) VALUES (:id_usuario, :descricao)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_usuario' => $id_usuario, 'descricao' => $descricao]);

    echo "<p>Sua solicitação foi enviada com sucesso!</p>";
}?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/consultoria.css" media="screen" />
  <title>Solicitar Consultoria</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <article class="contact__container">
    <div class="wrapper__title">
      <h2 class="title">Solicitar Consultoria</h2>
      <p class="subtitle">Diga-nos oque precisa e faremos uma consultoria especializada</p>
    </div>
    <div class="contact__wrapper">
      <form action="enviar_contato.php" method="post" class="login__form">
        <div class="wrapper__input">
          <label for="message">Mensagem</label>
          <textarea name="descricao" required></textarea><br>
        </div>
        <input class="contact_button" type="submit" value="Enviar Solicitação">
      </form>
    </div>
  </article>
  <?php include('inc/footer.php'); ?>
</body>

</html>