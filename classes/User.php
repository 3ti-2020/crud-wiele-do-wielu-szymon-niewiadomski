<?php

require_once '../php/connect.php';

class User{
    private $id;
    private $username;
    private $password;
    private $role;
    private $permissions = [];

    public static function findById($id){
        return self::find($sql = "SELECT * FROM users WHERE id=$id");
    }

    public static function findByUsername($username){
        return self::find($sql = "SELECT * FROM users WHERE username='$username'");
    }

    private static function find($sql){
        global $db;
        $result = $db->query($sql);
        $user = null;

        if($result){
            if($result->num_rows == 0) return $user;

            $userdata = $result->fetch_assoc();
            $userdata['permissions'] = self::getPermissionsFromRole($userdata['role']);
            $user = new self($userdata);

        } else
            die($db->error);

        return $user;
    }

    private static function getPermissionsFromRole($id){
        global $db;
        $sql = "SELECT * from permissions_roles WHERE role_id=$id";
        $result = $db->query($sql);
        $permissions = [];

        if($result){
            foreach($result->fetch_all() as $permission){
                array_push($permissions, $permission[0]);
            }
        } else
            die($db->error);

        return $permission;
    }

    public function __construct($userdata){
        $this->id = $userdata['id'];
        $this->username = $userdata['username'];
        $this->role = $userdata['role'];
        $this->password = $userdata['password'];
        $this->permissions = $userdata['permissions'];
    }

    public function hasPermission($permission){
        if(in_array($permission, $this->permissions))
            return true;
        else
            return false;
    }

    public function getId(){return $this->id;}
    public function getUsername(){return $this->username;}
    public function getPassword(){return $this->password;}
    public function getRole(){return $this->role;}
    public function getPermissions(){return $this->permissions;}
}