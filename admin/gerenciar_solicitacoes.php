<?php
include('../config.php');
session_start();

// Verificar autenticação e permissões...

include('../inc/header.php');

echo "<h2>Gerenciar Solicitações de Consultoria</h2>";

$sql = "SELECT id_solicitacao, id_usuario, descricao, status FROM SolicitacoesConsultoria";
$stmt = $pdo->query($sql);

echo "<table><tr><th>ID</th><th>ID Usuário</th><th>Descrição</th><th>Status</th><th>Ações</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id_solicitacao']}</td>
            <td>{$row['id_usuario']}</td>
            <td>{$row['descricao']}</td>
            <td>{$row['status']}</td>
            <td>
                <a href='alterar_status_solicitacao.php?id={$row['id_solicitacao']}'>Alterar Status</a>
                <a href='excluir_solicitacao.php?id={$row['id_solicitacao']}' onclick='return confirm(\"Tem certeza?\");'>Excluir</a>
            </td>
          </tr>";
}
echo "</table>";

include('../inc/footer.php');
?>
