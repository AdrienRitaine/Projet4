<?php

$this->_t = "◄ Panel d'administration ►";
$this->_style = "Panel";
$this->_titre = "Signalements";
require('config.php');

?>

<section class="body">
    <table>
        <tr>
            <th>PSEUDO</th>
            <th>COMMENTAIRE</th>
            <th>ACTION</th>
        </tr>
        <?php foreach($infos['comments'] as $comment): ?>
            <tr>
                <td><?= $comment->pseudo() ?></td>
                <td><?= $comment->commentaire() ?></td>
                <td class="action">
                    <a href="<?= $url ?>Panel/deleteComment/<?= $comment->id() ?>"><i class="fas fa-trash-alt"></i></a>
                    <a href="<?= $url ?>Panel/acceptComment/<?= $comment->id() ?>"><i class="fas fa-check"></i></a>
                </td>
            </tr>
        <?php endforeach ?>

    </table>
</section>





