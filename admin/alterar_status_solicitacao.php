<?php
include('../config.php');
session_start();

// Verificar autenticação e permissões...

$id_solicitacao = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    // Atualizar o status da solicitação no banco de dados
    $sql = "UPDATE SolicitacoesConsultoria SET status = :status WHERE id_solicitacao = :id_solicitacao";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute(['status' => $status, 'id_solicitacao' => $id_solicitacao]);

    if ($success) {
        echo "<p>Status da solicitação atualizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao atualizar o status da solicitação.</p>";
    }
}

// Buscar o status atual
$sql = "SELECT status FROM SolicitacoesConsultoria WHERE id_solicitacao = :id_solicitacao";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_solicitacao' => $id_solicitacao]);
$solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);

include('../inc/header.php');
?>

<h2>Alterar Status da Solicitação</h2>
<form method="post">
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="pendente" <?php echo $solicitacao['status'] == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
        <option value="em progresso" <?php echo $solicitacao['status'] == 'em progresso' ? 'selected' : ''; ?>>Em progresso</option>
        <option value="concluido" <?php echo $solicitacao['status'] == 'concluido' ? 'selected' : ''; ?>>Concluído</option>
    </select>
    <input type="submit" value="Atualizar Status">
</form>

<?php include('../inc/footer.php'); ?>
