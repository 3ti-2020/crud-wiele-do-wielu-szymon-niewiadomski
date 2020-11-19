<?php

require_once '../php/connect.php';

class User{
    private $id;
    private $username;
    private $password;
    private $role;
    private $permissions;

    public static function find($id){
        global $db;
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $db->query($sql);

        if($result){
            if($result->num_rows == 0) return null;

            $data = $result->fetch_assoc();
            $user = new self($data['id'], $data['id'], $data['id'], $data['id']);
        } else
            die($db->error);
    }

    public function __construct($id, $username, $password, $role, $permisson){
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
        $this->password = $password;
        $this->permissions = $permissions;
    }

    public function getId(){return $this->id;}
    public function getUsername(){return $this->username;}
    public function getPassword(){return $this->password;}
    public function getRole(){return $this->role;}
    public function getPermissions(){return $this->permissions;}
}