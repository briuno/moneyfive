<?php include('inc/header.php'); include('auth_check.php');?>
<!-- Conteúdo da página de contato aqui -->
<h2>Contato</h2>
<p>Tem perguntas ou precisa de ajuda? Entre em contato conosco.</p>
<!-- Incluir um formulário de contato aqui -->
<form action="enviar_contato.php" method="post">
    Nome: <input type="text" name="nome"><br>
    E-mail: <input type="email" name="email"><br>
    Mensagem:<br>
    <textarea name="mensagem"></textarea><br>
    <input type="submit" value="Enviar">
</form>
<?php include('inc/footer.php'); ?>
