<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include('auth_check.php');
include('config.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$success = false;
$error = false;

// Tratar o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $id_usuario = $_SESSION['id_usuario'];

    // Inserir a solicitação no banco de dados
    $sql = "INSERT INTO SolicitacoesConsultoria (id_usuario, descricao) VALUES (:id_usuario, :descricao)";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(['id_usuario' => $id_usuario, 'descricao' => $descricao])) {
      $success = true;
    } else {
      $error = true;
    }

}
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
  <link rel="stylesheet" type="text/css" href="css/consultoria.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />
  <!-- Toastify CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <title>Solicitar Consultoria</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <main class="contact__container">
    <div class="wrapper__title">
      <h2 class="title">Solicitar Consultoria</h2>
      <p class="subtitle">Diga-nos oque precisa e faremos uma consultoria especializada</p>
    </div>
    <div class="contact__wrapper">
      <form action="solicitar_consultoria.php" method="post" class="login__form" aria-label="Formulário de Consultoria">
        <div class="wrapper__input">
          <label for="message">Mensagem</label>
          <textarea name="descricao" required aria-required="true" aria-label="Descrição"></textarea><br>
        </div>
        <input class="contact_button" type="submit" value="Enviar Solicitação" aria-label="Enviar Solicitação">
      </form>
    </div>
  </main>
  <?php include('inc/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script>
    <?php if ($success): ?>
      Toastify({
        text: "Perfil atualizado com sucesso!",
        duration: 2000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#38b000",
      }).showToast();
    <?php elseif ($error): ?>
      Toastify({
        text: "Houve um erro ao atualizar seu perfil, tente novamente mais tarde!",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#FF0A0A"
      }).showToast();
    <?php endif; ?>
  </script>
</body>

</html>
