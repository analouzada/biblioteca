<?php
require_once '../Config/config.php';
require_once 'App/Controller/LivroController.php';
require_once 'App/Controller/EmprestimoController.php';

session_start();

$livroController = new LivroController($pdo);
$emprestimoController = new EmprestimoController($pdo);

$livros = $livroController->listarLivros();

$livrosPorCategoria = [];
foreach ($livros as $livro) {
    $categoria = $livro['categoria'];
    if (!isset($livrosPorCategoria[$categoria])) {
        $livrosPorCategoria[$categoria] = [];
    }
    $livrosPorCategoria[$categoria][] = $livro;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emprestar'])) {
    $livroID = $_POST['livro_id'];
    $livroNome = $_POST['nome'];
    $usuarioNome = $_SESSION['usuarioNomedeUsuario'];

    $emprestimoController->emprestarLivro($livroID, $livroNome, $usuarioNome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['devolver'])) {
    $livroID = $_POST['livro_id'];

    $emprestimoController->devolverLivro($livroID);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="Public/Js/script.js"></script>
    <script src="Public/Js/emprestimo.js"></script>
    <link rel="shortcut icon" href="Public/Assets/_31554896-b491-466e-b129-d77e088c3b0c-removebg-preview.png" type="image/x-icon">
    <title>Lista de Livros</title>
</head>
<body>

<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background: linear-gradient(to right, #4527a0, #7b1fa2); /* Gradient from deep purple to dark purple */
            color: #fff;
            padding: 20px;
            text-align: center;
            width: 100%;
        }

        .user-icon {
    cursor: pointer;
    position: fixed;
    top: -504px;
    right: 15px;
    font-size: 24px;
    color: #7b1fa2;
}

        .user-info {
            display: none;
            position: fixed;
            top: 70px;
            right: 15px;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user-info h2 {
            margin-bottom: 10px;
            color: #4e4e4e;
        }

        button {
            background-color: #7b1fa2; /* Dark Purple */
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4527a0; /* Deeper Purple */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            background: linear-gradient(to right, #4527a0, #7b1fa2); /* Gradient from deep purple to dark purple */
            border: 2px solid #7b1fa2; /* Dark Purple */
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background: linear-gradient(to right, #4527a0, #4527a0); /* Same Deep Purple */
        }

        main {
            width: 80%;
            max-width: 1200px;
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        h2 {
            color: #7b1fa2; /* Dark Purple */
            margin-top: 20px;
        }

        li {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            width: 200px; /* Adjust width as needed */
        }

        img {
            margin-bottom: 10px;
            max-width: 150px; /* Adjust width as needed */
            border-radius: 5px;
        }

        form {
            margin-top: 10px;
        }
    </style>
    <div class="user-icon" id="user-icon" onclick="showUserInfo()">
        <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div class="user-info" id="user-info">
        <?php include '../Login/verifica_login.php'; ?>
        <h2>Olá <?php echo $_SESSION['usuarioNomedeUsuario'], "!"; ?> </h2><br>
        <button onclick="logout()"><h6>Sair</h6></button>
    </div>

    <a href="index.php">Voltar</a>
    
    
</body>
</html>
