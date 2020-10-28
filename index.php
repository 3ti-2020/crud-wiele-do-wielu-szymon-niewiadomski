<?php
    require_once './table.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szymon Niewiadomski</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1>Szymon Niewiadomski Grp2</h1>
        <h3>Biblioteka</h3>
    </header>
    <aside class="aside">
        <div class="insert">
            <form action="insert.php" method="post" autocomplete="off" >
                <input type="text" name="name" class="input" placeholder="Imię" required>
                <input type="text" name="lastname" class="input" placeholder="Nazwisko" required>
                <input type="text" name="title" class="input" placeholder="Tytuł" required>
                <input type="submit" value="Dodaj książkę" class="button">
            </form>
        </div>
    </aside>
    <main class="main">
        <div class="library">
            <?php createTable("SELECT imie, nazwisko, tytul from autorzy, tytuly, ksiazki WHERE autorzy.id_autor = ksiazki.id_autor AND tytuly.id_tytul = ksiazki.id_tytul");?>
        </div>
    </main>
</body>
</html>