<?php 
    if (isset($_POST['submit'])) {
        setcookie('username', $_POST['username'], time() + 3600*24, "/");
        header('Location:index.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>City Rating</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>City Rating</h1>
        <form id="getUsername" method="post">
            <label>Bem-vindo</label>
            <label>Introduza o seu nome para aceder!</label>
            <input type="text" name="username" placeholder="Nome">
            <input type="submit" name="submit" value="Entrar">
        </form>
    </header>
</body>
</html>