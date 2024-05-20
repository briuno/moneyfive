<?php
include('auth_check.php');
include('../config.php');
session_start(); ?>

// Verificar autenticação e permissões...

include('../inc/adminHeader.php');

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
    <title>Solicitações</title>
</head>
<body>
    <?php include('../inc/adminHeader.php');?>
    <article class="admin__container">
<?php 
    echo "<h2 class='title'>Gerenciar Solicitações de Consultoria</h2>";

    $sql = "SELECT id_solicitacao, id_usuario, descricao, status FROM SolicitacoesConsultoria";
    $stmt = $pdo->query($sql);

    echo "<table class='table'><tr class='name'><th>ID</th><th class='name'>ID Usuário</th><th class='name'>Descrição</th><th class='name'>Status</th><th class='name'>Ações</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='table__wrapper'>
                <td class='row id'>{$row['id_solicitacao']}</td>
                <td class='row'>{$row['id_usuario']}</td>
                <td class='row'>{$row['descricao']}</td>
                <td class='row id'>{$row['status']}</td>
                <td class='row buttons'>
                    <a class='table__buttons edit ' href='alterar_status_solicitacao.php?id={$row['id_solicitacao']}'>Alterar Status</a>
                    <a class='table__buttons remove' href='excluir_solicitacao.php?id={$row['id_solicitacao']}' onclick='return confirm(\"Tem certeza?\");'>Excluir</a>
                </td>
            </tr>";
    }
    echo "</table>";
?>
</article>
<?php include('../inc/adminFooter.php');?>
</body>
</html>
