<?php

$this->_t = "Accueil";
$this->_style = "Accueil";
require('config.php');

?>


<header>
    <h1>Jean Forteroche</h1>
    <cite>"Un billet simple pour l'Alaska."</cite>
</header>
<section class="section">
    <h2 class="sectionTitle">Dernières publication</h2>
    <aside class="sectionExtrait">
        <?php
        $i = 0;
        foreach ($chapitres as $chapitre):
            ?>
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
            <?php
            if (++$i == 2) break;
        endforeach
        ?>
    </aside>
</section>




