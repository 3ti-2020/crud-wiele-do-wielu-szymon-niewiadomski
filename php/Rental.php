<?php
require_once('connect.php');

class Rental {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function rentBook($book, $user){
        $sql = "INSERT INTO wypozyczenia VALUES (null, $user, $book, now(), null)";
        if($this->db->query($sql))
            return true;
        else
            return $this->db->error;
    }

    public function returnBook($rent){
        $sql = "UPDATE wypozyczenia SET returned_date = now() WHERE id = $rent";
        if($this->db->query($sql))
            return true;
        else
            return $this->db->error;
    }

    public function getRents(){
        $sql = "SELECT * FROM wypozyczenia";
    }
}

if(isset($_POST['action'])){
    $rental = new Rental($db);

    switch($_POST['action']){
        case 'rent':
            echo($rental->rentBook($_POST['id_ksiazka'], $_POST['id_user']));
            break;
        case 'return':
            echo($rental->returnBook($_POST['id_wypozyczenie']));
            break;
    }

    header('Location: ../index.php');
}