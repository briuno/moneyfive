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
            // Gerar um código de verificação único
            $codigoVerificacao = rand(100000, 999999);

            // Enviar o código para o e-mail do usuário
            // Note: Substitua com sua lógica de envio de e-mail
            $para = $email;
            $assunto = "Código de Verificação";
            $mensagem = "Seu código de verificação é: " . $codigoVerificacao;
            // Função mail() para exemplo. Use uma biblioteca de e-mail para produção!
            mail($para, $assunto, $mensagem);

            // Inserir novo usuário no banco de dados com o código de verificação
            $sql = "INSERT INTO Usuarios (nome, email, senha, telefone, codigo_verificacao) VALUES (:nome, :email, :senha, :telefone, :codigo_verificacao)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senhaHash, 'telefone' => $telefone, 'codigo_verificacao' => $codigoVerificacao]);

            // Redirecionar para a página de verificação
            header("Location: verificar.php");
            exit;
        }
    }
}
?>

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
