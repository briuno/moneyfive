<?php
include('auth_check.php');
include('../config.php');
session_start();

// Verificar autenticação e permissões
if ($_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
  <title>Gerenciar Solicitações de Consultoria</title>
</head>
<body>
  <?php include('../inc/adminHeader.php'); ?>
  <main class="admin__container">
    <h2 class='title'>Gerenciar Solicitações de Consultoria</h2>

    <?php
    $sql = "SELECT id_solicitacao, id_usuario, descricao, status FROM SolicitacoesConsultoria";
    $stmt = $pdo->query($sql);

    echo "<table class='table'>
            <tr class='name'>
              <th>ID</th>
              <th class='name'>ID Usuário</th>
              <th class='name'>Descrição</th>
              <th class='name'>Status</th>
              <th class='name'>Ações</th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='table__wrapper'>
                <td class='row id'>" . htmlspecialchars($row['id_solicitacao']) . "</td>
                <td class='row'>" . htmlspecialchars($row['id_usuario']) . "</td>
                <td class='row'>" . htmlspecialchars($row['descricao']) . "</td>
                <td class='row id'>" . htmlspecialchars($row['status']) . "</td>
                <td class='row buttons'>
                    <a class='table__buttons edit' href='alterar_status_solicitacao.php?id=" . htmlspecialchars($row['id_solicitacao']) . "'>Alterar Status</a>
                    <a class='table__buttons remove' href='excluir_solicitacao.php?id=" . htmlspecialchars($row['id_solicitacao']) . "' onclick='return confirm(\"Tem certeza?\");'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
    ?>
  </main>
  <?php include('../inc/adminFooter.php'); ?>
</body>
</html>
