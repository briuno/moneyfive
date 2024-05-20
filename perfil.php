<?php
include('config.php');
include('auth_check.php');
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Tratar a atualização do perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Atualizar informações no banco de dados
    $sql = "UPDATE Usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'id_usuario' => $id_usuario]);

    echo "<p>Perfil atualizado com sucesso!</p>";
}

// Buscar informações atuais do usuário para preencher o formulário
$sql = "SELECT nome, email, telefone FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch();?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
    <title>Perfil</title>
</head>
<body>
<?php include('inc/header.php'); ?>
<article class="contact__container">
    <div class="wrapper__title">
      <h2 class="title">Editar Perfil</h2>
    </div>
    <div class="contact__wrapper">
      <form action="enviar_contato.php" method="post" class="login__form">
        <div class="wrapper__input">
          <label for="name">Nome</label>
          <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        </div>
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        </div>
        <div class="wrapper__input">
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
        </div>
        <input class="contact_button" type="submit" value="Atualizar Perfil">
      </form>
    </div>
  </article>
<?php include('inc/footer.php'); ?>
</body>
</html>
