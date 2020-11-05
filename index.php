<?php
session_start();
    require_once 'php/table.php';
    if(isset($_SESSION['admin']))
        echo $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szymon Niewiadomski</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <h1>Szymon Niewiadomski Grp2</h1>
        <h3>Biblioteka</h3>
    </header>
    <nav class="nav">
        <a href="https://github.com/3ti-2020/crud-wiele-do-wielu-szymon-niewiadomski">Github</a>
        <a href="cards.php">Karty</a>
        <?php if(isset($_SESSION['logged'])) echo '<a href="php/logout.php">Wyloguj się</a>'; ?>
    </nav>
    <aside class="aside">
        <?php if(!isset($_SESSION['logged'])){?>
            <form method="post" action="php/login.php" class="login-form">
                <label for="username">Nazwa użytkownika</label>
                <input type="text" name="username">
                <label for="password">Hasło</label>
                <input type="password" name="password">
                <input type="submit" value="Zaloguj się">
                <?php
                if(isset($error) && $error = true){
                    echo "<span class='error'>Nieprawidłowe dane logowania</span>";
                    unset($error);
                }
                ?>
            </form>

        <?php }?>
        <?php if(isset($_SESSION['logged'])){?>
        <div class="insert">
            <form action="php/insert.php" method="post" autocomplete="off" >
                <input type="text" name="name" class="input" placeholder="Imię" required>
                <input type="text" name="lastname" class="input" placeholder="Nazwisko" required>
                <input type="text" name="title" class="input" placeholder="Tytuł" required>
                <input type="submit" value="Dodaj książkę" class="button">
            </form>
        </div>
        <?php }?>
    </aside>
    <main class="main">
        <div class="library">
            <?php createTable("SELECT * from autorzy, tytuly, ksiazki WHERE autorzy.id_autor = ksiazki.id_autor AND tytuly.id_tytul = ksiazki.id_tytul", ["imie", "nazwisko", "tytul"]);?>
        </div>
    </main>
</body>
</html>