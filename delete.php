<?php

require_once 'connect.php';

if(isset($_POST['id_autor'])){
    $id_autor = $_POST['id_autor'];
    $id_ksiazka = $_POST['id_ksiazka'];
    $id_tytul = $_POST['id_tytul'];

    $db->query("DELETE from tytuly WHERE id_tytul = $id_tytul");
    $db->query("DELETE from ksiazki WHERE id_ksiazka = $id_ksiazka");

    $result = $db->query("SELECT * from ksiazki WHERE id_autor = $id_autor");

    if($result->num_rows == 0){
        $db->query("DELETE from autorzy WHERE id_autor = $id_autor");
    }
    
    header('Location: index.php');

}