<?php
// Inclua o arquivo de configuração
include('config.php');

// Variáveis para armazenar possíveis mensagens
$erro = '';
$sucesso = false;

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmacaoSenha = $_POST['confirmacaoSenha'];
    $telefone = $_POST['telefone'];

    if ($senha !== $confirmacaoSenha) {
        $erro = "As senhas não coincidem.";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha para segurança

        // Verificar se o e-mail já existe no banco de dados
        $sql = "SELECT id_usuario FROM Usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            $erro = "E-mail já cadastrado.";
        } else {
            // Gerar um código de verificação único
            $codigoVerificacao = rand(100000, 999999);

            // Enviar o código para o e-mail do usuário
            // Note: Substitua com sua lógica de envio de e-mail
            $para = $email;
            $assunto = "Código de Verificação";
            $mensagem = "Seu código de verificação é: " . $codigoVerificacao;
            // Função mail() para exemplo. Use uma biblioteca de e-mail para produção!
            mail($para, $assunto, $mensagem);

            // Inserir novo usuário no banco de dados com o código de verificação
            $sql = "INSERT INTO Usuarios (nome, email, senha, telefone, codigo_verificacao) VALUES (:nome, :email, :senha, :telefone, :codigo_verificacao)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senhaHash, 'telefone' => $telefone, 'codigo_verificacao' => $codigoVerificacao]);
            $sucesso = true;
        }
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
  <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/forms.css" media="screen" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <title>Cadastro</title>
</head>

<body>
  <main class="container">
    <section class="wrapper">
      <div class="wrapper__title">
        <a href="index.php"><img src="assets/logo.svg" alt="MoneyFive"></a>
        <div class="text__wrapper">
          <h2 class="title">Cadastro</h2>
          <p class="subtitle">Preencha para obter acesso à plataforma</p>
        </div>
      </div>
      <form method="post" class="login__form" aria-label="Formulário de Cadastro">
        <div class="wrapper__input">
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" required placeholder="Coloque seu nome" aria-required="true"
            aria-label="Nome Completo" />
        </div>
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required placeholder="Coloque seu email" aria-required="true"
            aria-label="Endereço de Email" />
        </div>
        <div class="wrapper__input">
          <label for="senha">Senha</label>
          <input type="password" name="senha" id="senha" required placeholder="Coloque sua senha" aria-required="true"
            aria-label="Senha" />
        </div>
        <div class="wrapper__input">
          <label for="confirmacaoSenha">Confirme a Senha</label>
          <input type="password" name="confirmacaoSenha" id="confirmacaoSenha" required placeholder="Confirme sua senha"
            aria-required="true" aria-label="Confirme a Senha" />
        </div>
        <div class="wrapper__input">
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" id="telefone" placeholder="Telefone" aria-label="Telefone" />
        </div>
        <input class="button" type="submit" value="Cadastrar" aria-label="Cadastrar">
      </form>
    </section>
    <section class="wrapper__image">
      <p>Tenha acesso a diversos dashboards para o gerenciamento de sua empresa.</p>
      <img class="dash__image" src="assets/home-dash.png" alt="Imagem ilustrativa de um dashboard">
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script>
  <?php if ($sucesso): ?>
  Toastify({
    text: "Cadastro realizado com sucesso, faça login para continuar!",
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    backgroundColor: "#38b000",
  }).showToast();
  setTimeout(function() {
    window.location.href = "login.php";
  }, 2000);
  <?php elseif ($erro): ?>
  Toastify({
    text: "<?php echo htmlspecialchars($erro); ?>",
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    backgroundColor: "#FF0A0A"
  }).showToast();
  <?php endif; ?>
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"
    integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
  $(document).ready(function() {
    // Aplica a máscara ao campo de telefone enquanto o usuário digita
    $('#telefone').inputmask('(99) 99999-9999');
  });
  </script>
</body>

</html>