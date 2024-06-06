<?php
include('../auth_check.php');
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
  <link rel="shortcut icon" href="assets/Favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/footer.css" media="screen" />
  <title>Gerenciar Solicitações de Consultoria</title>
</head>

<body>
  <?php include('../inc/adminHeader.php'); ?>
  <main class="admin__container">
    <h2 class='title'>Gerenciar Solicitações de Consultoria</h2>
    <div class="table__container">
      <?php
    $sql = "SELECT id_solicitacao, id_usuario, descricao, status FROM SolicitacoesConsultoria";
    $stmt = $pdo->query($sql);

    echo "<table class='table'>
            <tr class='name'>
              <th>ID</th>
              <th>ID Usuário</th>
              <th>Descrição</th>
              <th>Status</th>
              <th>Ações</th>
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
    </div>
  </main>
  <?php include('../inc/adminFooter.php'); ?>
</body>

</html>