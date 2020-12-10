<?php
    require_once 'classes/Post.php';

    $posts = Post::all();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szymon Niewiadomski</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
    <header class="header">
        <a href="https://github.com/3ti-2020/crud-wiele-do-wielu-szymon-niewiadomski" class="github">
            <img src="img/github.png" alt="Github">
        </a>

        <h1>Szymon Niewiadomski Grp2</h1>
        <h3>Biblioteka</h3>
    </header>
    <nav class="nav">
        <a href="https://github.com/3ti-2020/crud-wiele-do-wielu-szymon-niewiadomski">Github</a>
        <a href="cards.php">Karty</a>
        <a href="exam.html">Egzamin</a>
        <?php if(isset($_SESSION['logged'])) echo '<a href="php/logout.php">Wyloguj się</a>'; ?>
    </nav>
    <aside class="aside">
        
    </aside>
    <main class="main">
        <?php
        foreach($posts as $post){
            echo '<div class="post">
                <div class="post__title">'.$post->getTitle().' '.$post->getDate().'</div>
                <div class="post__content">'.$post->getContent().'</div>
            </div>';
        }
        ?>
    </main>
</body>
</html>