<?php

$this->_t = "◄ Panel d'administration ►";
$this->_style = "Panel";
$this->_titre = "Gestion des chapitres";
require('config.php');

?>

<section class="body">
    <a href="<?= $url ?>Panel/new" class="ajouterChapitre"><i class="fas fa-plus"></i></a>

    <table>
        <tr>
            <th>AUTEUR</th>
            <th>TITRE</th>
            <th>DATE</th>
            <th>ACTION</th>
        </tr>
        <?php foreach($infos['article'] as $article): ?>
        <tr>
            <td><?= $article->auteur() ?></td>
            <td><?= $article->titre() ?></td>
            <td><?= $article->date_creation() ?></td>
            <td class="action">
                <a href="<?= $url ?>Panel/delete/<?= $article->id() ?>"><i class="fas fa-trash-alt"></i></a>
                <a href="<?= $url ?>Panel/edit/<?= $article->id() ?>"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        <?php endforeach ?>

    </table>
</section>





