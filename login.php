<?php
// Inclua o arquivo de configuração
include('config.php');

// Variável para armazenar possíveis mensagens de erro
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Buscar usuário pelo e-mail
    $sql = "SELECT id_usuario, senha FROM Usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch();
        // Verificar a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, iniciar sessão
            session_start();
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            header("Location: dashboard.php"); // Redirecionar para a dashboard
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!-- HTML para o formulário de login -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/forms.css" media="screen" />
</head>

<body>
  <main class="container">
    <section class="wrapper">
      <div class="wrapper__title">
        <a href="index.php"><img src="assets/logo.svg" alt="Logo da MoneyFive"></a>
        <div class="text__wrapper">
          <h2 class="title">Login</h2>
          <p class="subtitle">Por favor entre com suas credenciais</p>
        </div>
      </div>
      <form method="post" class="login__form" aria-label="Formulário de Login">
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" required placeholder="Coloque seu email" aria-required="true"
            aria-label="Endereço de Email" />
        </div>
        <div class="wrapper__input">
          <label for="senha">Senha</label>
          <input type="password" name="senha" required placeholder="Coloque sua senha" aria-required="true"
            aria-label="Senha" />
        </div>
        <input class="button" type="submit" value="Entrar" aria-label="Entrar">
      </form>
      <p class="register">Ainda não possui uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </section>
    <section class="wrapper__image">
      <p>Tenha acesso a diversos dashboards para o gerenciamento de sua empresa.</p>
      <img class="dash__image" src="assets/home-dash.png" alt="Imagem ilustrativa de um dashboard">
    </section>
  </main>
  <?php if ($erro): ?>
  <p><?php echo $erro; ?></p>
  <?php endif; ?>
</body>

</html>