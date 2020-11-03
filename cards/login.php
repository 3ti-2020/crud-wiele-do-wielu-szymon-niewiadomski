<?php
session_start();

require_once "../connect.php";

if(isset($_POST['username'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    
    $sql = "SELECT * from users WHERE username='$username' AND password='$password'";

    $result = $db->query($sql);
    if($result)
        $_SESSION['logged'] = true;
    else
        $error = true;
}

if(isset($_SESSION['logged']))
    header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szymon Niewiadomski - Cards</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form method="post" class="login-form">
        <label for="username">Nazwa użytkownika</label>
        <input type="text" name="username">
        <label for="password">Hasło</label>
        <input type="password" name="password">
        <input type="submit" value="Zaloguj się">
        <?php
        if(isset($error) && $error = true){
            echo "<span class='error'>Nieprawidłowe dane logowania</span>";
            unset($error);
        }
        ?>
    </form>
</body>
</html>