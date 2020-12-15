<?php
require_once __DIR__.'/../php/connect.php';

class Post{
    private $id;
    private $title;
    private $content;
    private $date;

    public static function all(){
        global $db;
        $result = $db->query("SELECT * FROM posts ORDER BY date DESC");
        $posts = [];

        if($result){
            if($result->num_rows == 0) return $posts;

            $postsData = $result->fetch_all(MYSQLI_ASSOC);
            foreach($postsData as $postData){
                array_push($posts, new self($postData));
            }

        } else
            die($db->error);

        return $posts;
    }

    private static function find($id){
        global $db;
        $result = $db->query("SELECT * FROM posts WHERE id=$id");
        $post = null;

        if($result){
            if($result->num_rows == 0) return $user;

            $postData = $result->fetch_assoc();
            $post = new self($postData);
        } else
            die($db->error);

        return $post;
    }

    public function getTags(){
        global $db;
        $id =$this->id;
        $sql = "SELECT name from posts_tags JOIN tags ON tags.id = posts_tags.tag_id WHERE post_id=$id";
        $result = $db->query($sql);
        $tags = [];

        if($result){
            foreach($result->fetch_all() as $tag){
                array_push($tags, $tag[0]);
            }
        } else
            die($db->error);

        return $tags;
    }

    public function __construct($postData){
        $this->id = $postData['id'];
        $this->title = $postData['title'];
        $this->content = $postData['content'];
        $this->date = $postData['date'];
    }

    public function setTags($tags){
        global $db;
        $sql ="INSERT INTO posts_tags VALUES ";
        foreach($tags as $tag){
            $sql .= "(null, {$this->id}, $tag),";
        }
        $sql = substr_replace($sql ,"",-1);
        if(!$db->query($sql))
            die($db->error);
    }

    public function save(){
        global $db;
        $sql = "INSERT INTO posts VALUES (null, '{$this->title}', '{$this->content}', now())";
        
        if(!$db->query($sql))
            die($db->error);

        $this->id = $db->insert_id;
    }


    public function getId(){return $this->id;}
    public function getTitle(){return $this->title;}
    public function getContent(){return $this->content;}
    public function getDate(){return $this->date;}
}
