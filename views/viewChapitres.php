<?php
$this->_t = "Chapitres";
$this->_style = "Chapitres";
require('config.php');

?>

<section class="section">
    <div class="sectionExtrait">
        <?php foreach ($chapitres as $chapitre): ?>
            <div class="extraitBloc">
                <img class="extraitImg" src="<?= $url ?>assets/img/header.png" alt="montagne">
                <div class="extraitInfos">
                    <div class="extraitInfo">
                        <i class="fas fa-calendar-alt"></i>
                        <p><?= $chapitre->date_creation() ?></p>
                    </div>
                    <div class="extraitInfo">
                        <i class="fas fa-pen"></i>
                        <p><?= $chapitre->auteur() ?></p>
                    </div>
                </div>
                <div class="extraitDesc">
                    <h2><?= $chapitre->titre() ?></h2>
                    <div>
                        <p><?= $chapitre->contenu() ?></p>
                    </div>
                    <a href="<?= $url ?>Chapitres/v/<?= $chapitre->id() ?>">Lire plus...</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>



