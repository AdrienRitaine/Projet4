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
    <script src="https://cdn.tiny.cloud/1/sot1e4swh8wx314p7zha40xfcd2e5lv73c654k0yzd1nwmjs/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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

<div class="navHeader">
    <i class="fas fa-bars menu" id="navResp"></i>
    <h2 class="menuTitle"><?= $titre ?></h2>
</div>

<nav class="panelNav" id="panelNav">
    <i class="fas fa-window-close menuClose" id="navRespClose"></i>
    <a href="<?= $url ?>Accueil"><i class="fas fa-home"></i> Accueil</a>
    <a href="<?= $url ?>Panel/signalement"><i class="fas fa-exclamation-triangle"></i> Signalement</a>
    <a href="<?= $url ?>Panel/chapitre"><i class="fas fa-edit"></i> Chapitres</a>
</nav>

<!-- CONTENU -->
<?= $content ?>


<script>
    document.getElementById('navResp').addEventListener('click', (e) => {
        document.getElementById('panelNav').style.left = 0;
        document.getElementById('navResp').style.display = "none";
        document.getElementById('navRespClose').style.display = "block";
    });

    document.getElementById('navRespClose').addEventListener('click', (e) => {
        document.getElementById('panelNav').style.left = '-100%';
        document.getElementById('navResp').style.display = "block";
        document.getElementById('navRespClose').style.display = "none";
    });
</script>
</body>
</html>