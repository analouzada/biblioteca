<?php
require_once '../Config/config.php';
require_once 'App/Controller/UserController.php';

$userController = new UserController($pdo);

if (isset($_POST['nome']) && 
    isset($_POST['email']) &&
    isset($_POST['senha'])) 
{
    $userController->criarUser($_POST['nome'], $_POST['email'], $_POST['senha']);
    header('Location: #');
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../index/public/css/style2.css">
    <link rel="stylesheet" href="../index/public/css/style3.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
    
    <h1>Biblioteca Cia</h1>
    <h2>Fazer Cadastro</h2>
    <!-- Formulário de cadastro -->
    <form method="post">
        <input type="text" name="nome" placeholder="Nome Usuário" required><br>
        <input type="text" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Adicionar User</button>
        <a href="login.php">Voltar</a>
    </form>
    </div>
</body>
</html>