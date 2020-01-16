<?php

$this->_t = "◄ Panel d'administration ►";
$this->_style = "Panel";
$this->_titre = "Gestion des chapitres";
require('config.php');

?>

<section class="body">
    <a href="<?= $url ?>Panel/new" class="ajouterChapitre"><i class="fas fa-plus"></i></a>

    <table>
        <thead>
        <tr>
            <th>AUTEUR</th>
            <th>TITRE</th>
            <th>DATE</th>
            <th>ACTION</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($infos['chapitres'])) { ?>
            <?php foreach ($infos['chapitres'] as $chapitre): ?>
                <tr>
                    <td data-title="Auteur"><?= $chapitre->auteur() ?></td>
                    <td data-title="Titre"><?= $chapitre->titre() ?></td>
                    <td data-title="Date"><?= $chapitre->date_creation() ?></td>
                    <td class="action" data-title="Action">
                        <a href="<?= $url ?>Panel/delete/<?= $chapitre->id() ?>/<?= $_SESSION['token'] ?>"><i
                                    class="fas fa-trash-alt"></i></a>
                        <a href="<?= $url ?>Panel/edit/<?= $chapitre->id() ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php } else { ?>
            <tr>
                <td colspan="4">Aucun chapitre</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>





