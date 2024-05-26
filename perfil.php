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
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/contato.css" media="screen" />
    <title>Perfil</title>
</head>
<body>
<?php include('inc/header.php'); ?>
<main class="contact__container">
    <section class="wrapper__title">
        <h2 class="title">Editar Perfil</h2>
    </section>
    <section class="contact__wrapper">
        <form method="post" class="login__form" aria-label="Formulário de Perfil">
            <div class="wrapper__input">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required aria-required="true" aria-label="Nome Completo">
            </div>
            <div class="wrapper__input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required aria-required="true" aria-label="Endereço de Email">
            </div>
            <div class="wrapper__input">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>" aria-label="Telefone">
            </div>
            <input class="contact_button" type="submit" value="Atualizar Perfil" aria-label="Atualizar Perfil">
        </form>
    </section>
</main>
<?php include('inc/footer.php'); ?>
</body>
</html>
