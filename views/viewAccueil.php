<?php

$this->_t = "Accueil";
$this->_style = "Accueil";

foreach($articles as $article): ?>

<h2><?= $article->titre() ?></h2>
<time><?= $article->date_creation() ?></time>
<?php endforeach ?>