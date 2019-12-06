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
    <div class="sectionExtrait">
     <?php foreach($articles as $article): ?>
        <div class="extraitBloc">
            <img class="extraitImg" src="<?= $url ?>img/header.png" alt="montagne">
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
                <p><?= $article->contenu() ?></p>
                <a href="#">Lire plus...</a>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</section>



