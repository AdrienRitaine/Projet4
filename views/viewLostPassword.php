<?php
$this->_t = "Mot de passe oublié ?";
$this->_style = "Connexion";
require('config.php');
?>

    <div class="logForm">
        <div class="chooseForm">
            <a id="connexion">Mot de passe oublié ?</a>
        </div>
        <div class="signinForm" id="signinForm">
            <form class="formBloc" action="<?= $url ?>connexion/lostPassword" method="POST">
                <label for="pseudo"><i class="fas fa-envelope"></i> E-mail</label>
                <input class="pseudo inputText" type="email" name="email">
                <input class="submit" type="submit" name="submit" value="Envoyez">
            </form>
            <a class="button" href="<?= $url ?>Connexion">Retour</a>
        </div>
    </div>
<?=  $errorMsg ?>