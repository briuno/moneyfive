<?php
include('config.php');

// Variável para armazenar possíveis mensagens de erro ou sucesso
$mensagem = '';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $preferencias = isset($_POST['preferencias']) ? $_POST['preferencias'] : '';

    // Inserir o e-mail na tabela de assinaturas da newsletter
    try {
        $sql = "INSERT INTO AssinaturasNewsletter (email, preferencias, status) VALUES (:email, :preferencias, 'ativo')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'preferencias' => $preferencias]);
        $mensagem = "Inscrição realizada com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro ao inscrever o e-mail: " . $e->getMessage();
    }
}

include('inc/header.php');
?>

<h2>Inscreva-se na nossa Newsletter</h2>
<p>Receba as últimas notícias e atualizações diretamente no seu e-mail.</p>
<?php if ($mensagem): ?>
    <p><?php echo $mensagem; ?></p>
<?php endif; ?>
<form method="post">
    E-mail: <input type="email" name="email" required><br>
    Preferências: <input type="text" name="preferencias"><br>
    <input type="submit" value="Inscrever">
</form>

<?php include('inc/footer.php'); ?>
