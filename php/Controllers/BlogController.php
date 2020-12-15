<?php
require_once __DIR__.'/../../classes/Post.php';
require_once __DIR__.'/../connect.php';

class BlogController{

    public static function storePost($title, $content, $tags){
        $post = new Post(['title' => $title, 'content' => $content, 'id' => null, 'date' => null]);
        $post->save();
        $post->setTags($tags);
        
        header('Location: ../../blog.php');
    }

    public static function storeTags($tags){
        global $db;
        $tags = explode(',', $tags);
        $sql = "INSERT INTO tags VALUES ";
        $tagsCount = 0;
        
        foreach($tags as $tag){
            $tag = trim($tag);
            $result = $db->query("SELECT id FROM tags WHERE name='$tag'");
            if($result->num_rows == 0){
                $tagsCount++;
                $sql .= "(null, '$tag'),";
            }
        }
        $sql = substr_replace($sql ,"",-1);
        if($tagsCount >0 && !$db->query($sql))
            die($db->error);
    
        header('Location: ../../blog.php');
    }
}

if(isset($_POST['title'])){
    BlogController::storePost($_POST['title'], $_POST['content'], $_POST['post_tags']);
}

if(isset($_POST['tags'])){
    BlogController::storeTags($_POST['tags']);
}