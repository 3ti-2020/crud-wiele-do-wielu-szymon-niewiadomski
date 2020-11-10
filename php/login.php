<?php
session_start();

require_once "connect.php";

if(isset($_POST['username'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    
    $sql = "SELECT * from users WHERE username='$username' AND password='$password'";

    $result = $db->query($sql);
    if($result->num_rows == 1){
        $data = $result->fetch_assoc();
        $_SESSION['logged'] = true;
        $_SESSION['name'] = $data['username'];
        $_SESSION['user'] = $data['id'];
        $_SESSION['admin'] = $data['admin'];
    } else
        $_SESSION['error'] = true;
}

header('Location: ../index.php');
?>

