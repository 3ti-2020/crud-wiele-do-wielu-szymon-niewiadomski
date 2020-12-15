<?php
require_once __DIR__.'/../php/connect.php';

class tag{
    private $id;
    private $name;

    public static function all(){
        global $db;
        $result = $db->query("SELECT * FROM tags");
        $tags = [];

        if($result){
            if($result->num_rows == 0) return $tags;

            $tagsData = $result->fetch_all(MYSQLI_ASSOC);
            foreach($tagsData as $tagData){
                array_push($tags, new self($tagData));
            }

        } else
            die($db->error);

        return $tags;
    }

    private static function find($id){
        global $db;
        $result = $db->query("SELECT * FROM tags WHERE id=$id");
        $tag = null;

        if($result){
            if($result->num_rows == 0) return $user;

            $tagData = $result->fetch_assoc();
            $tag = new self($tagData);
        } else
            die($db->error);

        return $tag;
    }

    public function __construct($tagData){
        $this->id = $tagData['id'];
        $this->name = $tagData['name'];
    }

    public function save(){
        global $db;
        $sql = "INSERT INTO tags VALUES (null, '{$this->name}')";
        if(!$db->query($sql))
            die($db->error);
    }


    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
}