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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
  <title>Newsletter</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <article class="contact__container">
    <div class="wrapper__title">
      <h2 class="title">Inscreva-se na nossa Newsletter</h2>
      <p class="subtitle">Receba as últimas notícias e atualizações diretamente no seu e-mail.</p>
    </div>
    <div class="contact__wrapper">
      <?php if ($mensagem): ?>
      <p><?php echo $mensagem; ?></p>
      <?php endif; ?>
      <form method="post" class="login__form">
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" required placeholder="Coloque seu email" />
        </div>
        <div class="wrapper__input">
          <label for="preferencias">Preferências</label>
          <textarea name="preferencias"></textarea>
        </div>
        <input class="contact_button" type="submit" value="Enviar">
      </form>
    </div>
  </article>
  <?php include('inc/footer.php'); ?>
</body>

</html>
