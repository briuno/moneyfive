<?php
include('auth_check.php');
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminForms.css" media="screen" />
    <title>Alterar Solicitações</title>
</head>
<body>
<?php include('../inc/adminHeader.php');?>
<article class="admin__container">
    <h2 class="title">Alterar Status da Solicitação</h2>
    <div class="admin__wrapper">
      <form method="post" class="login__form">
        <div class="wrapper__input">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="pendente" <?php echo $solicitacao['status'] == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                <option value="em progresso" <?php echo $solicitacao['status'] == 'em progresso' ? 'selected' : ''; ?>>Em progresso</option>
                <option value="concluido" <?php echo $solicitacao['status'] == 'concluido' ? 'selected' : ''; ?>>Concluído</option>
            </select>
        </div>
        <input class="admin__button" type="submit" value="Atualizar Status">
      </form>
    </div>
  </article>
<?php include('../inc/adminFooter.php'); ?>
</body>
</html>
