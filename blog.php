<?php
    require_once 'classes/Post.php';
    require_once 'classes/Tag.php';

    $posts = Post::all();
    $tags = Tag::all();
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
        <a href="blog.php">Blog</a>
        <?php if(isset($_SESSION['logged'])) echo '<a href="php/logout.php">Wyloguj się</a>'; ?>
    </nav>
    <aside class="aside">
        <h3 class="aside__header">Nowy post</h3>
        <form action="php/Controllers/BlogController.php" method="post" class="form">
            <input type="text" name="title" placeholder="Tytuł" class="form__input">
            <textarea name="content" placeholder="Treść" class="form__input form__input--textarea"></textarea>
            <select name="post_tags[]" class="form__input form__input--select" multiple >
                <?php
                    foreach($tags as $tag){
                        echo "<option value='{$tag->getId()}'>{$tag->getName()}</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Dodaj" class="form__input form__input--submit">
        </form>

        <h3 class="aside__header">Nowe Tagi</h3>
        <form action="php/Controllers/BlogController.php" method="post" class="form">
            <input type="text" name="tags" placeholder="Tagi oddzielone przecinkami" class="form__input">
            <input type="submit" value="Dodaj" class="form__input form__input--submit">
        </form>
    </aside>
    <main class="main">
        <?php
        foreach($posts as $post){
            echo '<div class="post">
                <div class="post__header">
                    <h3 class="post__title">'.$post->getTitle().'</h3>
                    <div class="post__date">'. date_format(date_create($post->getDate()), 'H:i:s d.m.Y').'</div>
                </div>
                <div class="post__content">'.$post->getContent().'</div>
                <div class="post__tags">Tagi: '.implode(', ', $post->getTags()).'</div>
            </div>';
        }
        ?>
    </main>
</body>
</html>