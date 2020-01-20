<?php
$this->_t = "Profil";
$this->_style = "Profil";
require('config.php');

?>

<section class="section">
    <div class="sectionExtrait">
        <div id="back"></div>
        <form action="<?= $url ?>profil/avatar/<?= $infos['id'] ?>/<?= filter_var($_SESSION['token'], FILTER_SANITIZE_STRING) ?>"
              method="post" enctype="multipart/form-data">
            <label for="avatar">
                <div class="avatarDiv">
                    <img class="avatar" src="<?= $url ?>assets/img/avatars/<?= $infos['avatar'] ?>"
                         alt="avatar">
                    <p class="avatarLink"><i class="fas fa-edit"></i> Modifier</p>
                </div>
            </label>
            <input type="file" onchange="this.form.submit();" id="avatar" name="avatar">
        </form>
        <p class="pseudo"><?= $infos['pseudo'] ?></p>
        <p class="email"><i class="fas fa-envelope"></i> <?= $infos['email'] ?></p>
        <form id="changePwd"
              action="<?= $url ?>profil/password/<?= $infos['id'] ?>/<?= filter_var($_SESSION['token'], FILTER_SANITIZE_STRING) ?>"
              method="post">
            <label for="password"><i class="fas fa-lock"></i> Nouveau mot de passe</label>
            <input class="password inputText" type="password" name="password">
            <label for="passwordConfirm"><i class="fas fa-lock"></i> Confirmer le nouveau mot de passe</label>
            <input class="password inputText" type="password" name="passwordConfirm">
            <button class="editPassword"><i class="fas fa-key"></i> Modifier le mot de passe</button>
            <?= $infos['error'] ?>
        </form>
        <?php if ($_SESSION['permission'] == false) { ?>
            <a class="delete"
               href="<?= $url ?>profil/delete/<?= $infos['id'] ?>/<?= filter_var($_SESSION['token'], FILTER_SANITIZE_STRING) ?>"><i
                        class="fas fa-trash-alt"></i> Supprimer mon compte </a>
        <?php } ?>
    </div>
</section>



