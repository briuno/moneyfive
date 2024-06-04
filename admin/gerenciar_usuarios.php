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
    <title>Gerenciar Usuários</title>
</head>
<body>
<?php include('../inc/adminHeader.php'); ?>
<main class="admin__container">
    <h2 class="title">Gerenciar Usuários</h2>

    <?php
    $sql = "SELECT id_usuario, nome, email FROM Usuarios";
    $stmt = $pdo->query($sql);

    echo "<table class='table'>
            <tr>
                <th class='name'>ID</th>
                <th class='name'>Nome</th>
                <th class='name'>Email</th>
                <th class='name'>Ações</th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='table__wrapper'>
                <td class='row id'>" . htmlspecialchars($row['id_usuario']) . "</td>
                <td class='row'>" . htmlspecialchars($row['nome']) . "</td>
                <td class='row'>" . htmlspecialchars($row['email']) . "</td>
                <td class='row buttons'>
                    <a class='table__buttons edit' href='editar_usuario.php?id=" . htmlspecialchars($row['id_usuario']) . "'>Editar</a>
                    <a class='table__buttons remove' href='excluir_usuario.php?id=" . htmlspecialchars($row['id_usuario']) . "' onclick='return confirm(\"Tem certeza?\");'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
    ?>
</main>
<?php include('../inc/adminFooter.php'); ?>
</body>
</html>
