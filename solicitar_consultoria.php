<?php
include('config.php');
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Tratar o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $id_usuario = $_SESSION['id_usuario'];

    // Inserir a solicitação no banco de dados
    $sql = "INSERT INTO SolicitacoesConsultoria (id_usuario, descricao) VALUES (:id_usuario, :descricao)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_usuario' => $id_usuario, 'descricao' => $descricao]);

    echo "<p>Sua solicitação foi enviada com sucesso!</p>";
}

include('inc/header.php');
?>

<h2>Solicitar Consultoria</h2>
<form method="post">
    Descreva sua necessidade:<br>
    <textarea name="descricao" required></textarea><br>
    <input type="submit" value="Enviar Solicitação">
</form>

<?php include('inc/footer.php'); ?>
