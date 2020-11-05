<?php
session_start();

require_once "connect.php";

if(isset($_POST['username'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    
    $sql = "SELECT * from users WHERE username='$username' AND password='$password'";

    $result = $db->query($sql);
    if($result){
        $data = $result->fetch_assoc();
        $_SESSION['logged'] = true;
        $_SESSION['admin'] = $data['admin'];
    } else
        $error = true;
}

//header('Location: ../index.php');
?>

