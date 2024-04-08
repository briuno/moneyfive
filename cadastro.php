<?php
// Inclua o arquivo de configuração
include('config.php');

// Variável para armazenar possíveis mensagens de erro
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha para segurança
    $telefone = $_POST['telefone'];

    // Verificar se o e-mail já existe no banco de dados
    $sql = "SELECT id_usuario FROM Usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        $erro = "E-mail já cadastrado.";
    } else {
        // Inserir novo usuário no banco de dados
        $sql = "INSERT INTO Usuarios (nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha, 'telefone' => $telefone]);
        header("Location: login.php"); // Redirecionar para a página de login
    }
}
?>

<!-- HTML para o formulário de cadastro -->
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        E-mail: <input type="email" name="email" required><br>
        Senha: <input type="password" name="senha" required><br>
        Telefone: <input type="text" name="telefone"><br>
        <input type="submit" value="Cadastrar">
    </form>
    <?php if ($erro): ?>
        <p><?php echo $erro; ?></p>
    <?php endif; ?>
</body>
</html>
