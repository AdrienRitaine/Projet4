<?php require('config.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title><?= $t ?></title>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= $url ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= $url ?>css/style<?= $style ?>.css">
    </head>
    <body>
    <!-- MENU -->

    <nav id="nav">
        <div id="logo">
            <h1 class="logo">Forteroche</h1>
            <h1 class="logo">Jean</h1>
        </div>
        <i class="fas fa-bars menu_resp" id="menu_resp"></i>
        <div class="menu_lien" id="menu_lien">
            <div class="menu_liens">
                <i class="fas fa-times menu_resp_close" id="menu_resp_close"></i>
                <a class="nav-link" href="http://localhost/projet4/Accueil">Accueil</a>
                <a class="nav-link" href="#">Chapitres</a>
                <a class="nav-link" href="#">Contact</a>
                <a class="nav-link" href="http://localhost/projet4/Connexion">Connexion</a>
            </div>
        </div>
    </nav>

    <!-- CONTENU -->
    <?= $content ?>

    <!-- PIED DE PAGE -->

    <footer>
        <p>Par Ritaine Adrien !</p>
    </footer>
    <script src="<?= $url ?>js/app.js"></script>
    </body>
</html>