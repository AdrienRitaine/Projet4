<?php 
require('config.php'); 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title><?= $t ?></title>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= $url ?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= $url ?>assets/css/style<?= $style ?>.css">
    </head>
    <body>
    <!-- MENU -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    <nav id="nav">
        <div id="logo">
            <h1 class="logo">Forteroche</h1>
            <h1 class="logo">Jean</h1>
        </div>
        <i class="fas fa-bars menu_resp" id="menu_resp"></i>
        <div class="menu_lien" id="menu_lien">
            <div class="menu_liens">
                <i class="fas fa-times menu_resp_close" id="menu_resp_close"></i>
                <a class="nav-link" href="<?= $url ?>Accueil">Accueil</a>
                <a class="nav-link" href="<?= $url ?>Chapitres">Chapitres</a>
                <a class="nav-link" href="#">Contact</a>
                <?php if($_SESSION['connected'] === "yes"){?>
                    <?php if($_SESSION['permission'] === "1"){?>
                        <a class="nav-link" href="<?= $url ?>Panel">Panel</a>
                    <?php } ?>
                    <a class="nav-link conButton" href="<?= $url ?>Connexion/deconnexion">Déconnexion</a>
                <?php }else{ ?>
                    <a class="nav-link conButton" href="<?= $url ?>Connexion">Connexion</a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <!-- CONTENU -->
    <?= $content ?>

    <!-- PIED DE PAGE -->

    <footer>
        <p>Par Ritaine Adrien !</p>
    </footer>
    <script src="<?= $url ?>assets/js/app.js"></script>
    </body>
</html>