<?php

require_once 'connect.php';

function existInDB($sql){
    global $db;
    $result = $db->query($sql);
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        return  $data['id_autor'];
    } else {
        return false;
    }

}

function addToDB($sql){
    global $db;
    if($db->query($sql)) return true;
    else return false;
}

if(isset($_POST['name'])){
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $title = trim($_POST['title']);

    $sqlAutor = "SELECT id_autor from autorzy WHERE imie = '$name' AND nazwisko = '$lastname'";
    $existAutor = existInDB($sqlAutor);

    if($existAutor == false){
      if(addToDB("INSERT into autorzy VALUES (NULL, '$name', '$lastname')")) $autorID = $db->insert_id;
      else {
          echo 'Błąd sqlAddAutor';
          exit();
        }
    } else $autorID = $existAutor;

    $sqlAddTitle = "INSERT into tytuly VALUES (NULL, '$title')";

    if(addToDB($sqlAddTitle)){
        $titleID = $db->insert_id;
    } else {
        echo 'Błąd sqlAddTitle';
        exit();
    }

    $sqlAddBook = "INSERT into ksiazki VALUES (NULL, $titleID, $autorID)";

    if(addToDB($sqlAddBook)){
        header('Location: index.php');
    } else {
        echo 'Błąd sqlAddBook';
        exit();
    }

} else header('Location: index.php');