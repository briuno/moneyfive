<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
  <title>Contato</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <article class="contact__container">
    <div class="wrapper__title">
      <h2 class="title">Faça parte do nosso time</h2>
      <p class="subtitle">Entre em contato e receba soluções lucrativas</p>
    </div>
    <div class="contact__wrapper">
      <form action="enviar_contato.php" method="post" class="login__form">
        <div class="wrapper__input">
          <label for="name">Nome</label>
          <input type="text" name="name" required placeholder="Coloque seu nome" />
        </div>
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" required placeholder="Coloque seu email" />
        </div>
        <div class="wrapper__input">
          <label for="message">Mensagem</label>
          <textarea name="message"></textarea>
        </div>
        <input class="contact_button" type="submit" value="Enviar">
      </form>
    </div>
  </article>
  <?php include('inc/footer.php'); ?>
</body>
</html>
