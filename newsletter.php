<?php
include('config.php');
include('auth_check.php');

// Variável para armazenar possíveis mensagens de erro ou sucesso
$mensagem = '';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $preferencias = isset($_POST['preferencias']) ? $_POST['preferencias'] : '';

    // Inserir o e-mail na tabela de assinaturas da newsletter
    try {
        $sql = "INSERT INTO AssinaturasNewsletter (email, preferencias, status) VALUES (:email, :preferencias, 'ativo')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'preferencias' => $preferencias]);
        $mensagem = "Inscrição realizada com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro ao inscrever o e-mail: " . $e->getMessage();
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
  <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />
  <title>Newsletter</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <main class="contact__container">
    <section class="wrapper__title">
      <h2 class="title">Inscreva-se na nossa Newsletter</h2>
      <p class="subtitle">Receba as últimas notícias e atualizações diretamente no seu e-mail.</p>
    </section>
    <section class="contact__wrapper" aria-label="Formulário de Newsletter">
      <?php if ($mensagem): ?>
      <p><?php echo htmlspecialchars($mensagem); ?></p>
      <?php endif; ?>
      <form method="post" class="login__form">
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required placeholder="Coloque seu email" aria-required="true" aria-label="Endereço de Email" />
        </div>
        <div class="wrapper__input">
          <label for="preferencias">Preferências</label>
          <textarea name="preferencias" id="preferencias" placeholder="Digite suas preferências" aria-label="Preferências"></textarea>
        </div>
        <input class="contact_button" type="submit" value="Enviar" aria-label="Enviar">
      </form>
    </section>
  </main>
  <?php include('inc/footer.php'); ?>
</body>

</html>

