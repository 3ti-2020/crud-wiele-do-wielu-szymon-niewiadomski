<?php

require_once 'connect.php';

if(isset($_POST['autor'])){
    $id_autor = $_POST['autor'];

    $sqlTitles = "SELECT id_tytul from ksiazki WHERE id_autor = $id_autor";
    $result = $db->query($sqlTitles);
    while($row = $result->fetch_array()){
        $id = $row['id_tytul'];
        $sql = "DELETE from tytuly WHERE id_tytul = $id";
        $db->query($sql);
    }

    $db->query("DELETE from autorzy WHERE id_autor = $id_autor");
    $db->query("DELETE from ksiazki WHERE id_autor = $id_autor");

    header('Location: index.php');
} 

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