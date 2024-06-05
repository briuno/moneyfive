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
  <link rel="shortcut icon" href="assets/Favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/header.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/footer.css" media="screen" />
  <title>Gerenciar Assinaturas da Newsletter</title>
</head>
<body>
  <?php include('../inc/adminHeader.php'); ?>
  <main class="admin__container">
    <h2 class="title">Gerenciar Assinaturas da Newsletter</h2>
    <?php 
    $sql = "SELECT id_assinatura, email, preferencias, status FROM AssinaturasNewsletter";
    $stmt = $pdo->query($sql);

    echo "<table class='table'><tr><th class='name'>ID</th><th class='name'>Email</th><th class='name'>Preferências</th><th class='name'>Status</th><th class='name'>Ações</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='table__wrapper'>
                <td class='row id'>" . htmlspecialchars($row['id_assinatura']) . "</td>
                <td class='row'>" . htmlspecialchars($row['email']) . "</td>
                <td class='row'>" . htmlspecialchars($row['preferencias']) . "</td>
                <td class='row'>" . htmlspecialchars($row['status']) . "</td>
                <td class='row buttons'>
                    <a class='table__buttons remove' href='cancelar_assinatura.php?id=" . htmlspecialchars($row['id_assinatura']) . "' onclick='return confirm(\"Tem certeza?\");'>Cancelar Assinatura</a>
                </td>
            </tr>";
    }
    echo "</table>";
    ?>
  </main>
  <?php include('../inc/adminFooter.php'); ?>
</body>
</html>
