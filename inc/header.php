<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyFive TESTE</title>
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>
    <?php session_start(); ?>
    <header>
        <h1><a href="index.php">MoneyFive TESTE V1.2.0</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <?php if(isset($_SESSION['id_usuario'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="solicitar_consultoria.php">Solicitar Consultoria</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="cadastro.php">Cadastro</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>

