<?php
include('config.php');
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Buscar informações do usuário
$sql = "SELECT nome, email FROM Usuarios WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$usuario = $stmt->fetch();

include('inc/header.php');
?>

<h2>Dashboard</h2>
<p>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</p>
<ul>
    <li><a href="solicitar_consultoria.php">Solicitar Consultoria</a></li>
    <li><a href="perfil.php">Editar Perfil</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<?php include('inc/footer.php'); ?>
