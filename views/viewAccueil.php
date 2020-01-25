<?php

$this->_t = "Accueil";
$this->_style = "Accueil";
require('config.php');

?>


<header>
    <h2>Jean Forteroche</h2>
    <cite>"Un billet simple pour l'Alaska."</cite>
</header>
<section class="section">
    <h2 class="sectionTitle">Dernières publication</h2>
    <div class="sectionExtrait">
        <?php
        $i = 0;
        foreach ($chapitres as $chapitre):
            ?>
            <div class="extraitBloc">
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
                        <p><?= $chapitre->content() ?></p>
                    </div>
                    <a href="<?= $url ?>Chapitres/v/<?= $chapitre->id() ?>">Lire plus...</a>
                </div>
            </div>
            <?php
            if (++$i == 2) break;
        endforeach
        ?>
    </div>
</section>




