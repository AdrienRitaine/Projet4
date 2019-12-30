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
<nav class="panelNav">
    <a href="<?= $url ?>Accueil"><i class="fas fa-home"></i> Accueil</a>
    <a href="<?= $url ?>membres"><i class="fas fa-users"></i> Membres</a>
    <a href="#"><i class="fas fa-comments"></i> Commentaires</a>
    <a href="#"><i class="fas fa-edit"></i> Chapitres</a>
</nav>

<!-- CONTENU -->
<?= $content ?>


<script src="<?= $url ?>assets/js/app.js"></script>
</body>
</html>