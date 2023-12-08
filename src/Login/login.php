<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../index/public/css/style2.css">
    <link rel="stylesheet" href="../index/public/css/style3.css">
    <title>Login</title>
</head>
<body>
<!-- Erro que se dá caso o email ou senha for inválido -->


<?php
if(isset($_SESSION['nao_autenticado'])):
    echo '<p style="color: red;">Usuário ou senha inválidos!</p>';
    unset($_SESSION['nao_autenticado']);
endif;
?>
<div class="container">
<!-- Formulário para login -->
<img src="Yellow Blue Simple Cute Book Store Logo.png" >
<h1>Biblioteca Cia</h1>
<form action="loginconfig.php" method="POST">
    <label for="nome">
        <input type="text" name="email" placeholder="E-mail ou Nome de Usuário">
</label>
<label for="senha">
    <input type="password" name="senha" placeholder="Senha">
    </label>
    <button type="submit">Login</button>
</form> 
<a href="cadastro.php">Crie sua conta</a>
</div>

</body>
</html>
