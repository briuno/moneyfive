<?php
include('auth_check.php');
include('../config.php');
session_start();?>

// Verificar autenticação e permissões...

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
    <title>Newsletter</title>
</head>
<body>
<?php include('../inc/adminHeader.php');?>
<article class="admin__container">
<?php 
    echo "<h2 class='title'>Gerenciar Assinaturas da Newsletter</h2>";

    $sql = "SELECT id_assinatura, email, preferencias, status FROM AssinaturasNewsletter";
    $stmt = $pdo->query($sql);

    echo "<table class='table'><tr><th class='name'>ID</th><th class='name'>Email</th><th class='name'>Preferências</th><th class='name'>Status</th><th class='name'>Ações</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='table__wrapper'>
                <td class='row id'>{$row['id_assinatura']}</td>
                <td class='row'>{$row['email']}</td>
                <td class='row'>{$row['preferencias']}</td>
                <td class='row'>{$row['status']}</td>
                <td class='row buttons'>
                    <a class='table__buttons remove' href='cancelar_assinatura.php?id={$row['id_assinatura']}' onclick='return confirm(\"Tem certeza?\");'>Cancelar Assinatura</a>
                </td>
            </tr>";
    }
    echo "</table>";
?>
</article>
<?php include('../inc/adminFooter.php');?>
</body>
</html>
