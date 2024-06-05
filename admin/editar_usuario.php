<?php
include('auth_check.php');
include('../config.php');
session_start();

// Verificar autenticação e permissões
if ($_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

$id_usuario = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar informações do usuário
$sql = "SELECT nome, email, telefone FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    // Validação dos dados de entrada
    if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Atualizar usuário no banco de dados
        $sql = "UPDATE Usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'id_usuario' => $id_usuario]);

        if ($success) {
            $message = "Usuário atualizado com sucesso!";
        } else {
            $message = "Erro ao atualizar o usuário.";
            $error = true;
        }
    } else {
        $message = "Dados inválidos.";
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/Favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/adminForms.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/footer.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Editar Usuário</title>
</head>
    <body>
    <?php include('../inc/adminHeader.php'); ?>
    <article class="admin__container">
        <h2 class="title">Editar Usuário</h2>
        <div class="admin__wrapper">
            <?php if (isset($message)) : ?>
                <strong><?php echo htmlspecialchars($message); ?></strong>
            <?php endif; ?>
            <form method="post" class="login__form" aria-label="Formulário de Usuário">
                <div class="wrapper__input">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required aria-required="true" aria-label="Nome Completo">
                </div>
                <div class="wrapper__input">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required aria-required="true" aria-label="Endereço de Email">
                </div>
                <div class="wrapper__input">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>"
                        aria-label="Telefone">
                </div>
                <input class="admin__button" type="submit" value="Salvar Alterações" aria-label="Salvar Alterações">
            </form>
        </div>
    </article>
    <?php include('../inc/adminFooter.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
    <?php if ($success): ?>
      Toastify({
        text: <?php echo json_encode($message); ?>,
        duration: 2000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#38b000",
      }).showToast();
    <?php elseif ($error): ?>
      Toastify({
        text: <?php echo json_encode($message); ?>,
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
    </body>
</html>
