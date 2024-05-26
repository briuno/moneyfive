<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/home.css" media="screen" />
  <title>Home</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <main class="main__container">
    <section class="main__wrapper">
      <div class="text__wrapper">
        <h1 class="title">Bem-vindo ao <span>MoneyFive<span class="copy">©</span></span></h1>
        <p class="subtitle">Conectamos donos de pequenos e médios negócios com consultores financeiros para ajudar a tomar decisões informadas.</p>
        <p class="text">Explore nossos Dashboards: Uma coleção diversificada de insights poderosos e visuais impactantes para impulsionar sua tomada de decisão.</p>
      </div>
      <div class="wrapper__buttons">
        <a class="button" href="cadastro.php" aria-label="Faça parte do MoneyFive">Faça parte</a>
        <a class="cadastrar" href="contato.php" aria-label="Saiba mais sobre o MoneyFive">Saiba mais</a>
      </div>
    </section>
    <section class="wrapper__image">
      <p class="text__image">Faça parte do nosso time e tenha acesso a insights detalhados para você!</p>
      <img class="main__image" src="assets/about-p2.svg" alt="Imagem ilustrativa sobre consultoria financeira e dashboards">
      <p class="text__image">Seu futuro com dados estratégicos começa agora!</p>
    </section>
  </main>
  <?php include('inc/footer.php'); ?>
</body>

</html>
