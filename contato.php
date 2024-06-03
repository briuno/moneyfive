<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
  <title>Contato</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <main class="contact__container">
    <section class="wrapper__title">
      <h2 class="title">Seja Nosso Parceiro</h2>
      <p class="subtitle">Entre em contato e aproveite nossas soluções rentáveis</p>
    </section>
    <section class="contact__wrapper" aria-label="Formulário de Contato">
      <form action="enviar_contato.php" method="post" class="login__form">
        <div class="wrapper__input">
          <label for="name">Nome</label>
          <input type="text" name="name" id="name" required placeholder="Coloque seu nome" aria-required="true" aria-label="Nome Completo" />
        </div>
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required placeholder="Coloque seu email" aria-required="true" aria-label="Endereço de Email" />
        </div>
        <div class="wrapper__input">
          <label for="message">Mensagem</label>
          <textarea name="message" id="message" placeholder="Digite sua mensagem" aria-label="Mensagem"></textarea>
        </div>
        <input class="contact_button" type="submit" value="Enviar" aria-label="Enviar">
      </form>
    </section>
  </main>
  <?php include('inc/footer.php'); ?>
</body>

</html>
