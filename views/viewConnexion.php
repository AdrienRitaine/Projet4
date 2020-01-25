<?php
$this->_t = "Connexion / Inscription";
$this->_style = "Connexion";
require('config.php');
?>

    <!-- LOGFORM -->
    <div class="logForm" id="logForm">
        <div class="chooseForm">
            <a id="connexion">CONNEXION</a>
            <a id="inscrire">S'INSCRIRE</a>
        </div>
        <div class="loginForm" id="loginForm">
            <form class="formBloc" action="<?= $url ?>connexion/login" method="POST">
                <label for="pseudo"><i class="fas fa-user"></i> Pseudo</label>
                <input class="pseudo inputText" type="text" name="pseudo">
                <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
                <input class="password inputText" type="password" name="password">
                <div class="inputCheckbox">
                    <input class="save" id="save" type="checkbox" name="save">
                    <label for="save">Se souvenir de moi ?</label>
                </div>
                <input class="submit" type="submit" name="submit" value="SE CONNECTER">
            </form>
            <a href="<?= $url ?>connexion/lostpassword">Mot de passe oublié ?</a>
        </div>

        <div class="signinForm" id="signinForm">
            <form class="formBloc" action="<?= $url ?>connexion/register" method="POST">
                <label for="pseudo"><i class="fas fa-user"></i> Pseudo</label>
                <input class="pseudo inputText" type="text" name="pseudo">
                <label for="pseudo"><i class="fas fa-envelope"></i> E-mail</label>
                <input class="pseudo inputText" type="email" name="email">
                <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
                <input class="password inputText" type="password" name="password">
                <label for="passwordConfirm"><i class="fas fa-lock"></i> Confirmer le mot de passe</label>
                <input class="password inputText" type="password" name="passwordConfirm">
                <div class="inputCheckbox">
                    <input class="save" id="acceptCGU" type="checkbox" name="save">
                    <label for="acceptCGU">J'accepte les CGU.</label>
                </div>
                <input class="submit" type="submit" name="submit" value="S'INSCRIRE">
            </form>
        </div>
    </div>
<?= $errorMsg ?>