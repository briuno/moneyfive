<?php
include('auth_check.php');
include('../config.php');
session_start();

// Verificar autenticação e permissões...

$id_usuario = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar informações do usuário
$sql = "SELECT nome, email, telefone FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Atualizar usuário no banco de dados
    $sql = "UPDATE Usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'id_usuario' => $id_usuario]);

    if ($success) {
        echo "<p>Usuário atualizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao atualizar o usuário.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminForms.css" media="screen" />
    <title>Editar Usuario</title>
</head>
<body>
<?php include('../inc/adminHeader.php');?>
<article class="admin__container">
    <h2 class="title">Editar Usuário</h2>
    <div class="admin__wrapper">
      <form method="post" class="login__form">
        <div class="wrapper__input">
          <label for="name">Nome</label>
          <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        </div>
        <div class="wrapper__input">
          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        </div>
        <div class="wrapper__input">
          <label for="email">Telefone</label>
          <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
        </div>
        <input class="admin__button" type="submit" value="Salvar Alterações">
      </form>
    </div>
  </article>
<?php include('../inc/adminFooter.php'); ?>
</body>
</html>
