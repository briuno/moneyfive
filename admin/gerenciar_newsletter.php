<?php
include('../config.php');
session_start();

// Verificar autenticação e permissões...

include('../inc/header.php');

echo "<h2>Gerenciar Assinaturas da Newsletter</h2>";

$sql = "SELECT id_assinatura, email, preferencias, status FROM AssinaturasNewsletter";
$stmt = $pdo->query($sql);

echo "<table><tr><th>ID</th><th>Email</th><th>Preferências</th><th>Status</th><th>Ações</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id_assinatura']}</td>
            <td>{$row['email']}</td>
            <td>{$row['preferencias']}</td>
            <td>{$row['status']}</td>
            <td>
                <a href='cancelar_assinatura.php?id={$row['id_assinatura']}' onclick='return confirm(\"Tem certeza?\");'>Cancelar Assinatura</a>
            </td>
          </tr>";
}
echo "</table>";

include('../inc/footer.php');
?>
