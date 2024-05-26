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
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/consultoria.css" media="screen" />
  <title>Solicitar Consultoria</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <main class="contact__container">
    <div class="wrapper__title">
      <h2 class="title">Solicitar Consultoria</h2>
      <p class="subtitle">Diga-nos o que precisa e faremos uma consultoria especializada</p>
    </div>
    <div class="contact__wrapper">
      <form method="post" class="login__form" aria-label="Formulário de Consultoria">
        <div class="wrapper__input">
          <label for="descricao">Mensagem</label>
          <textarea name="descricao" id="descricao" required aria-required="true" aria-label="Descrição"></textarea><br>
        </div>
        <input class="contact_button" type="submit" value="Enviar Solicitação" aria-label="Enviar Solicitação">
      </form>
    </div>
  </main>
  <?php include('inc/footer.php'); ?>
</body>

</html>
