<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include('auth_check.php');
include('config.php');

$id_usuario = $_SESSION['id_usuario'];
$success = false;
$error = false;

// Tratar a atualização do perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Atualizar informações no banco de dados
    $sql = "UPDATE Usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'id_usuario' => $id_usuario])) {
      $success = true;
    } else {
      $error = true;
    }

}

// Buscar informações atuais do usuário para preencher o formulário
$sql = "SELECT nome, email, telefone FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />
  <!-- Toastify CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <title>Perfil</title>
</head>

<body>
  <?php include('inc/header.php'); ?>
  <main class="contact__container">
    <section class="wrapper__title">
      <h2 class="title">Editar Perfil</h2>
    </section>
    <section class="contact__wrapper">
      <form action="perfil.php" method="post" class="login__form" aria-label="Formulário de Perfil">
        <div class="wrapper__input">
          <label for="name">Nome</label>
          <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required
            aria-required="true" aria-label="Nome Completo">
        </div>
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required
            aria-required="true" aria-label="Endereço de Email">
        </div>
        <div class="wrapper__input">
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>"
            aria-label="Telefone">
        </div>
        <input class="contact_button" type="submit" value="Atualizar Perfil" aria-label="Atualizar Perfil">
      </form>
    </section>
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