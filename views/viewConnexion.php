<?php
$this->_t = "Connexion / Inscription";
$this->_style = "Connexion";
require('config.php');
?>

    <!-- LOGFORM -->
    <main class="logForm" id="logForm">
        <div class="chooseForm">
            <a id="connexion">CONNEXION</a>
            <a id="inscrire">S'INSCRIRE</a>
        </div>
        <div class="loginForm" id="loginForm">
            <form class="formBloc" action="<?= $url ?>connexion/login" method="POST">
                <label for="pseudo"><i class="fas fa-user"></i> Pseudo</label>
                <input id="pseudo" class="pseudo inputText" type="text" name="pseudo">
                <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
                <input id="password" class="password inputText" type="password" name="password">
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
                <label for="pseudoReg"><i class="fas fa-user"></i> Pseudo</label>
                <input id="pseudoReg" class="pseudo inputText" type="text" name="pseudo">
                <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                <input id="email" class="pseudo inputText" type="email" name="email">
                <label for="passwordReg"><i class="fas fa-lock"></i> Mot de passe</label>
                <input id="passwordReg" class="password inputText" type="password" name="password">
                <label for="passwordConfirm"><i class="fas fa-lock"></i> Confirmer le mot de passe</label>
                <input id="passwordConfirm" class="password inputText" type="password" name="passwordConfirm">
                <div class="inputCheckbox">
                    <input class="save" id="acceptCGU" type="checkbox" name="save">
                    <label for="acceptCGU">J'accepte les CGU.</label>
                </div>
                <input class="submit" type="submit" name="submit" value="S'INSCRIRE">
            </form>
        </div>
    </main>

    <script>
        // FORMULAIRE DE CONNEXION

        var login = document.getElementById("loginForm");
        var inscrire = document.getElementById("signinForm");
        document.getElementById('connexion').addEventListener("click", function (e) {
            document.getElementById('logForm').style.height = '400px';
            login.style.display = "block";
            inscrire.style.display = "none";
            this.style.opacity = "1";
            document.getElementById("inscrire").style.opacity = "0.5";

        });
        document.getElementById('inscrire').addEventListener("click", function (e) {
            document.getElementById('logForm').style.height = '540px';
            login.style.display = "none";
            inscrire.style.display = "block";
            this.style.opacity = "1";
            document.getElementById("connexion").style.opacity = "0.5";
        });


    </script>
<?= $errorMsg ?>