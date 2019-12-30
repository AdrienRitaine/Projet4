<?php
$this->_t = "Mot de passe oublié ?";
$this->_style = "Connexion";
require('config.php');
?>

    <!-- LOGFORM -->
    <div class="logForm">
        <div class="chooseForm">
            <a id="connexion">Mot de passe oublié ?</a>
        </div>
        <div class="loginForm">
            <form class="formBloc" action="<?= $url ?>user/reset/<?=  $infos['recovery'] ?>/<?=  $infos['id'] ?>" method="POST">
                <label for="password"><i class="fas fa-lock"></i> Nouveau mot de passe</label>
                <input class="password inputText" type="password" name="password">
                <input class="submit" type="submit" name="submit" value="Valider">
            </form>
            <?=  $infos['error'] ?>
        </div>
    </div>
