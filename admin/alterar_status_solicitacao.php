<?php
include('auth_check.php');
include('../config.php');
session_start();

// Verificar autenticação e permissões...

$id_solicitacao = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'] ?? '';

    // Validar o status recebido
    $valid_statuses = ['pendente', 'em progresso', 'concluido'];
    if (in_array($status, $valid_statuses)) {
        // Atualizar o status da solicitação no banco de dados
        $sql = "UPDATE SolicitacoesConsultoria SET status = :status WHERE id_solicitacao = :id_solicitacao";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute(['status' => $status, 'id_solicitacao' => $id_solicitacao]);

        if ($success) {
            $message = "Status da solicitação atualizado com sucesso!";
        } else {
            $message = "Erro ao atualizar o status da solicitação.";
            $error = true;
        }
    } else {
        $message = "Status inválido.";
        $error = true;
    }
}

// Buscar o status atual
$sql = "SELECT status FROM SolicitacoesConsultoria WHERE id_solicitacao = :id_solicitacao";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_solicitacao' => $id_solicitacao]);
$solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Alterar Solicitações</title>
</head>
<body>
<?php include('../inc/adminHeader.php'); ?>
<article class="admin__container">
    <h2 class="title">Alterar Status da Solicitação</h2>
    <div class="admin__wrapper">
        <?php if (isset($message)) : ?>
            <strong><?php echo htmlspecialchars($message); ?></strong>
        <?php endif; ?>
        <form method="post" class="login__form" aria-label="Formulário de Solicitação">
            <div class="wrapper__input">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="pendente" <?php echo $solicitacao['status'] == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                    <option value="em progresso" <?php echo $solicitacao['status'] == 'em progresso' ? 'selected' : ''; ?>>Em progresso</option>
                    <option value="concluido" <?php echo $solicitacao['status'] == 'concluido' ? 'selected' : ''; ?>>Concluído</option>
                </select>
            </div>
            <input class="admin__button" type="submit" value="Atualizar Status" aria-label="Atualizar Status">
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
</body>
</html>
