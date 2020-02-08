<?php
require('config.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?= $t ?></title>

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?= $url ?>assets/js/alert.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>assets/css/style<?= $style ?>.css">


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
            <a class="nav-link" href="<?= $url ?>accueil">Accueil</a>
            <a class="nav-link" href="<?= $url ?>chapitres">Chapitres</a>
            <?php if ($_SESSION['connected'] === "yes") { ?>
                <a class="nav-link" href="<?= $url ?>profil/edit/<?= $_SESSION['userId'] ?>">Profil</a>
                <?php if ($_SESSION['permission'] === "1") { ?>
                    <a class="nav-link" href="<?= $url ?>panel">Panel</a>
                <?php } ?>
                <a class="nav-link conButton" href="<?= $url ?>connexion/deconnexion">Déconnexion</a>
            <?php } else { ?>
                <a class="nav-link conButton" href="<?= $url ?>connexion">Connexion</a>
            <?php } ?>
        </div>
    </div>
</nav>

<!-- CONTENU -->
<?= $content ?>

<!-- PIED DE PAGE -->

<footer>
    <div class="social">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"> <i class="fab fa-twitter-square"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
    <div class="plan">
        <a href="<?= $url ?>Accueil">Accueil</a>
        <a href="<?= $url ?>Chapitres">Chapitres</a>
        <?php if ($_SESSION['connected'] === "yes") { ?>
            <?php if ($_SESSION['permission'] === "1") { ?>
                <a href="<?= $url ?>Panel">Panel</a>
            <?php } ?>
            <a href="<?= $url ?>Connexion/deconnexion">Déconnexion</a>
        <?php } else { ?>
            <a href="<?= $url ?>Connexion">Connexion</a>
        <?php } ?>
    </div>
    <div class="copy">
        <p>© 2020 -<a href="https://adrien-ritaine.online"> RITAINE Adrien</a></p>
    </div>
</footer>

<script src="<?= $url ?>assets/js/app.js"></script>

</body>
</html>