<?php

$this->_t = "◄ Panel d'administration ►";
$this->_style = "Panel";
$this->_titre = "Signalements";
require('config.php');

?>

<main class="body">
    <table>
        <tr>
            <th>PSEUDO</th>
            <th>COMMENTAIRE</th>
            <th>ACTION</th>
        </tr>
        <?php if (count($infos['comments'])) { ?>
            <?php foreach ($infos['comments'] as $comment): ?>
                <tr>
                    <td><?= $comment->pseudo() ?></td>
                    <td><?= $comment->comment() ?></td>
                    <td class="action">
                        <a href="<?= $url ?>Panel/deleteComment/<?= $comment->id() ?>/<?= $_SESSION['token'] ?>"><i
                                    class="fas fa-trash-alt"></i></a>
                        <a href="<?= $url ?>Panel/acceptComment/<?= $comment->id() ?>"><i class="fas fa-check"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php } else { ?>
            <tr>
                <td colspan="3">Aucun signalement</td>
            </tr>
        <?php } ?>

    </table>
</main>





