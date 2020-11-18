<?php
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
        $_SESSION['admin'] = $data['role'] == 1;

        $sql = "SELECT permission_id FROM permissions_roles WHERE role_id = ".$data['role'];
        $result = $db->query($sql);
        if($result){
            $permissions = [];
            foreach($result->fetch_all() as $permission){
                array_push($permissions, $permission[0]);
            }
            $_SESSION['permissions'] = $permissions;
        } else
            echo $db->error;
    } else
        $_SESSION['error'] = true;
}

header('Location: ../index.php');
?>

