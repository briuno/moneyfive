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

include('../inc/header.php');
?>

<h2>Editar Usuário</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br>
    E-mail: <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br>
    Telefone: <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>"><br>
    <input type="submit" value="Salvar Alterações">
</form>

<?php include('../inc/footer.php'); ?>
