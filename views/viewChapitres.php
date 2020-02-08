<?php
$this->_t = "Chapitres";
$this->_style = "Chapitres";
require('config.php');

?>

<h2 class="title">Chapitres</h2>
<main class="section">
    <div class="sectionExtrait">
        <?php foreach ($chapitres as $chapitre): ?>
            <figure class="extraitBloc">
                <img class="extraitImg" src="<?= $url ?>assets/img/header.png" alt="montagne">
                <div class="extraitInfos">
                    <div class="extraitInfo">
                        <i class="fas fa-calendar-alt"></i>
                        <p><?= $chapitre->date_creation() ?></p>
                    </div>
                    <div class="extraitInfo">
                        <i class="fas fa-pen"></i>
                        <p><?= $chapitre->pseudo() ?></p>
                    </div>
                </div>
                <div class="extraitDesc">
                    <h2><?= $chapitre->title() ?></h2>
                    <div>
                        <?= $chapitre->content() ?>
                    </div>
                    <a href="<?= $url ?>Chapitres/v/<?= $chapitre->id() ?>">Lire plus...</a>
                </div>
            </figure>
        <?php endforeach ?>
    </div>
</main>



