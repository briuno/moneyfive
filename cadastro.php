<?php
// Inclua o arquivo de configuração
include('config.php');

// Variável para armazenar possíveis mensagens de erro
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmacaoSenha = $_POST['confirmacaoSenha'];
    $telefone = $_POST['telefone'];

    if ($senha !== $confirmacaoSenha) {
        $erro = "As senhas não coincidem.";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha para segurança

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
            $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senhaHash, 'telefone' => $telefone]);
            header("Location: login.php"); // Redirecionar para a página de login
            exit; // Encerrar a execução do script após o redirecionamento
        }
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
        Confirme a Senha: <input type="password" name="confirmacaoSenha" required><br>
        Telefone: <input type="text" name="telefone"><br>
        <input type="submit" value="Cadastrar">
    </form>
    <?php if ($erro): ?>
        <p><?php echo $erro; ?></p>
    <?php endif; ?>
</body>
</html>
