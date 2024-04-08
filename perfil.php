<?php
include('config.php');
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
$usuario = $stmt->fetch();

include('inc/header.php');
?>

<h2>Editar Perfil</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br>
    E-mail: <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br>
    Telefone: <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>"><br>
    <input type="submit" value="Atualizar Perfil">
</form>

<?php include('inc/footer.php'); ?>
