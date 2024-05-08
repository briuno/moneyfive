<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyFive</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
</head>
<body>
    <?php session_start(); ?>
    <header class="container">
        <nav class="wrapper">
            <a class="image" href="index.php">
                <img src="assets/logo.svg" alt="logo">
            </a>
            <ul>
                <li><a class="header__link" href="index.php">Home</a></li>
                <li><a class="header__link" href="sobre.php">Sobre</a></li>
                <li><a class="header__link" href="contato.php">Contato</a></li>
                <li><a class="header__link" href="faq.php">FAQ</a></li>
                <?php if(isset($_SESSION['id_usuario'])): ?>
                    <li><a class="header__link" href="dashboard.php">Dashboard</a></li>
                    <li><a class="header__link" href="solicitar_consultoria.php">Solicitar Consultoria</a></li>
                    <li><a class="header__link" href="perfil.php">Perfil</a></li>
                    <li class="button"><a class="header__link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="button"><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>

