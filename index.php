<?php
    require_once 'php/table.php';
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
        <?php if(!isset($_SESSION['logged'])){?>
            <form method="post" action="php/login.php" class="login-form">
                <label for="username">Nazwa użytkownika</label>
                <input type="text" name="username">
                <label for="password">Hasło</label>
                <input type="password" name="password">
                <input type="submit" value="Zaloguj się">
                <?php
                if(isset($_SESSION['error'])){
                    echo "<span class='error'>Nieprawidłowe dane logowania</span>";
                    unset($_SESSION['error']);
                }
                ?>
            </form>

            <table class="users">
                <tr>
                    <th>Login</th><th>Hasło</th>
                </tr>
                <tr>
                    <td>tom</td><td>a</td>
                </tr>
                <tr>
                    <td>admin</td><td>a</td>
                </tr>
                <tr>
                    <td>uczen</td><td>b</td>
                </tr>
            </table>

        <?php } else{
            echo '<div class="user">'.$_SESSION['user']->getName().'</div>';
        }        
        ?>
        <?php if(isset($_SESSION['logged']) && $_SESSION['admin'] == 1){?>
        <div class="insert">
           
            <form action="php/insert.php" method="post" autocomplete="off" >
                <input type="text" name="name" class="input" placeholder="Imię" required>
                <input type="text" name="lastname" class="input" placeholder="Nazwisko" required>
                <input type="text" name="title" class="input" placeholder="Tytuł" required>
                <input type="submit" value="Dodaj książkę" class="button">
            </form>
        </div>

        <div class="hire">
           
            <form action="php/Rental.php" method="post" autocomplete="off" >
            <input type="hidden" name="action" value="rent">
                <select name="id_ksiazka" class="input">
                <?php
                        $sql = "SELECT imie as Imię, nazwisko as Nazwisko, id_ksiazka, autorzy.id_autor as id_autor, tytuly.id_tytul as id_tytul, tytul as Tytuł FROM ksiazki JOIN tytuly ON tytuly.id_tytul = ksiazki.id_tytul JOIN autorzy ON autorzy.id_autor = ksiazki.id_autor WHERE id_ksiazka NOT IN (SELECT book FROM wypozyczenia WHERE returned_date IS NULL)";
                        $result = $db->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo '<option value="'.$row['id_ksiazka'].'">'.$row['Tytuł'].' '.$row['Imię'].' '.$row['Nazwisko'].'</option>';
                            } 
                        } else echo '<option value="null">Brak dostępnych książek</option>';
                    ?>
                </select>
                <select name="id_user" class="input">
                    <?php
                        $sql = "SELECT * from users";
                        $result = $db->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo '<option value="'.$row['id'].'">'.$row['username'].'</option>';
                            } 
                        } else echo '<option value="null">Brak użytkowników</option>';
                    ?>
                </select>
                <input type="submit" value="Wypożycz" class="button">
            </form>
        </div>
        <?php }?>
    </aside>
    <main class="main">
        <div class="library">
            <div class="books">
                <h2>Dostępne książki</h2>
                <?php createTable("SELECT imie as Imię, nazwisko as Nazwisko, id_ksiazka, autorzy.id_autor as id_autor, tytuly.id_tytul as id_tytul, tytul as Tytuł FROM ksiazki JOIN tytuly ON tytuly.id_tytul = ksiazki.id_tytul JOIN autorzy ON autorzy.id_autor = ksiazki.id_autor WHERE id_ksiazka NOT IN (SELECT book FROM wypozyczenia WHERE returned_date IS NULL)", ["Imię", "Nazwisko", "Tytuł"], "books");?>
            </div>    
            <?php 
                if(isset($_SESSION['logged'])){
                    echo '<div class="rents">';
                    echo '<h2>Wypożyczenia</h2>';
                    if($_SESSION['admin'] == 0)
                        echo createTable("SELECT id, id_ksiazka, tytul as Tytuł, returned_date as `Data zwrotu`, hire_date as `Data wypożyczenia` from wypozyczenia JOIN ksiazki ON wypozyczenia.book = ksiazki.id_ksiazka JOIN tytuly ON tytuly.id_tytul = ksiazki.id_tytul WHERE user = ".$_SESSION['user'] ." ORDER BY returned_date IS NULL DESC, hire_date DESC LIMIT 10" , ["Tytuł", "Data wypożyczenia", "Data zwrotu"], "rents");
                    else
                        echo createTable("SELECT wypozyczenia.id as id, id_ksiazka, tytul as Tytuł, returned_date as `Data zwrotu`, hire_date as `Data wypożyczenia`, username as Użytkownik from wypozyczenia JOIN ksiazki ON wypozyczenia.book = ksiazki.id_ksiazka JOIN tytuly ON tytuly.id_tytul = ksiazki.id_tytul JOIN users ON users.id = wypozyczenia.user WHERE returned_date IS NULL ORDER BY hire_date DESC LIMIT 25" , ["Użytkownik", "Tytuł", "Data wypożyczenia", "Data zwrotu"], "rents");

                    echo '</div>';
                }
            ?>
        </div>
    </main>
</body>
</html>