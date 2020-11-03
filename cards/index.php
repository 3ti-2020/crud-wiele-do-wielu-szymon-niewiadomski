<?php
    session_start();
    if(!isset($_SESSION['logged']))
        header('Location: login.php');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szymon Niewiadomski - Cards</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <nav class="nav">
        <a href="../index.php">Strona główna</a>
        <a href="logout.php">Wyloguj się</a>
        <a href="https://github.com/3ti-2020/crud-wiele-do-wielu-szymon-niewiadomski">Github</a>
        
    </nav>
    <div class="cards">
        <div class="card" id="tokyoTower">
            <div class="card-image"></div>
            <div class="card-text">
                <span class="date">4 dni temu</span>
                <h2>Tokyo Tower</h2>
                <p>Wieża telewizyjno-radiowa z punktem obserwacyjnym położona w Tokio, w parku Shiba, w dzielnicy Minato. Została ukończona w 1958 roku i ma 333 metry wysokości.</p>
            </div>
            <div class="card-stats">
                <div class="stat">
                    <div class="value">2m</div>
                    <div class="type">read</div>
                </div>
                <div class="stat">
                    <div class="value">2137</div>
                    <div class="type">views</div>
                </div>
                <div class="stat">
                    <div class="value">12</div>
                    <div class="type">comments</div>
                </div>
            </div>
        </div>
        <div class="card" id="mountainFuji">
            <div class="card-image"></div>
            <div class="card-text">
                <span class="date">2 tygodnie temu</span>
                <h2>Góra Fuji</h2>
                <p>Czynny stratowulkan i zarazem najwyższy szczyt Japonii (3776 m n.p.m.). Leży na wyspie Honsiu, na południowy zachód od stolicy, Tokio.</p>
            </div>
            <div class="card-stats">
                <div class="stat">
                    <div class="value">5m</div>
                    <div class="type">read</div>
                </div>
                <div class="stat">
                    <div class="value">4500</div>
                    <div class="type">views</div>
                </div>
                <div class="stat">
                    <div class="value">53</div>
                    <div class="type">comments</div>
                </div>
            </div>
        </div>
        <div class="card" id="himejiCastle">
            <div class="card-image"></div>
            <div class="card-text">
                <span class="date">miesiąc temu</span>
                <h2>Zamek Himeji</h2>
                <p> japoński zamek, znajdujący się w centrum miasta Himeji, w prefekturze Hyōgo, około 50 km na zachód od Kobe. Jest to jedna z najstarszych, istniejących do dziś budowli Japonii.</p>
            </div>
            <div class="card-stats">
                <div class="stat">
                    <div class="value">2m</div>
                    <div class="type">read</div>
                </div>
                <div class="stat">
                    <div class="value">12343</div>
                    <div class="type">views</div>
                </div>
                <div class="stat">
                    <div class="value">133</div>
                    <div class="type">comments</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>