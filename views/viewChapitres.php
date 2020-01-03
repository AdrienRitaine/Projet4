<?php
$this->_t = "Chapitres";
$this->_style = "Chapitres";
require('config.php');

?>

<section class="section">
    <div class="sectionExtrait">
     <?php foreach($articles as $article): ?>
        <div class="extraitBloc">
            <img class="extraitImg" src="<?= $url ?>assets/img/header.png" alt="montagne">
            <div class="extraitInfos">
                <div class="extraitInfo">
                    <i class="fas fa-calendar-alt"></i>
                    <p><?= $article->date_creation() ?></p>
                </div>
                <div class="extraitInfo">
                    <i class="fas fa-pen"></i>
                    <p><?= $article->auteur() ?></p>
                </div>
            </div>
            <div class="extraitDesc">
                <h2><?= $article->titre() ?></h2>
                <div>
                    <p><?= $article->contenu() ?></p>
                </div>
                <a href="<?= $url ?>Chapitres/v/<?= $article->id() ?>">Lire plus...</a>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</section>



