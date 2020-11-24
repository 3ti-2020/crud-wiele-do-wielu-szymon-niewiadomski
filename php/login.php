<?php
require_once "../classes/User.php";

if(isset($_POST['username'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    
    $user = User::findByUsername($username);

    if($user != null && $user->getPassword() == $password){
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = true;
        $_SESSION['admin'] = $user->getRole() == 1;
    } else
        $_SESSION['error'] = true;
}

header('Location: ../index.php');
?>

