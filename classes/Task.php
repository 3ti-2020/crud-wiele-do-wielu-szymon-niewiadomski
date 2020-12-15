<?php
namespace classes;

require_once '../php/connect.php';

class Task{
    private $id;
    private $user_id;
    private $name;
    private $doned;
    private $tags; 
    public static function all($user_id){
        global $db;
        $result = $db->query("SELECT * FROM tasks WHERE user_id=$user_id");
        $tasks = [];

        if($result){
            if($result->num_rows == 0) return $tasks;

            $tasksData = $result->fetch_all(MYSQLI_ASSOC);
            foreach($tasksData as $taskData){
                array_push($tasks, new self($taskData));
            }

        } else
            die($db->error);

        return $tasks;
    }

    private static function find($task_id){
        global $db;
        $result = $db->query("SELECT * FROM tasks WHERE id=$task_id");
        $task = null;

        if($result){
            if($result->num_rows == 0) return $task;

            $taskData = $result->fetch_assoc();
            $task = new self($taskData);

        } else
            die($db->error);

        return $task;
    }

    public function insert(){
        global $db;
        if($this->id == null){
            $sql = "INSERT INTO tasks VALUES(null, {$this->user_id}, '{$this->name}', false)";
            $result = $db->query($sql);
            if(!$result)
                return false;
        }

        return true;
    }

    public function doTask(){
        global $db;
        $sql = "UPDATE tasks SET doned = {$this->doned}";
        $result = $db->query($sql);
        if($result)
            return true;
        else
            return false;
    }

    
    public function __construct($taskData){
        $this->id = $taskData['id'];
        $this->user_id = $taskData['user_id'];
        $this->name = $taskData['name'];
        $this->doned = $taskData['doned'];
    }


    public function getId(){return $this->id;}
    public function getUserId(){return $this->user_id;}
    public function getName(){return $this->name;}
}