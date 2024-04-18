<?php
include('auth_check.php');
include('../config.php');
session_start();

// Verificar autenticação e permissões...

include('../inc/header.php');

echo "<h2>Gerenciar Usuários</h2>";

$sql = "SELECT id_usuario, nome, email FROM Usuarios";
$stmt = $pdo->query($sql);

echo "<table><tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id_usuario']}</td>
            <td>{$row['nome']}</td>
            <td>{$row['email']}</td>
            <td>
                <a href='editar_usuario.php?id={$row['id_usuario']}'>Editar</a>
                <a href='excluir_usuario.php?id={$row['id_usuario']}' onclick='return confirm(\"Tem certeza?\");'>Excluir</a>
            </td>
          </tr>";
}
echo "</table>";

include('../inc/footer.php');
?>
