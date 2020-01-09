<?php

$this->_t = "◄ Panel d'administration ►";
$this->_style = "Panel";
$this->_titre = "Membres";
require('config.php');

?>

<section class="body">
    <table>
        <tr>
            <th>PSEUDO</th>
            <th>EMAIL</th>
            <th>ACTION</th>
        </tr>
        <?php if(count($infos['membres'])){ ?>
            <?php foreach($infos['membres'] as $comment): ?>
                <tr>
                    <td><?= $comment->pseudo() ?></td>
                    <td><?= $comment->email() ?></td>
                    <td class="action">
                        <a href="<?= $url ?>Panel/deleteUser/<?= $comment->id() ?>/<?= $_SESSION['token'] ?>"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php } else { ?>
        <tr>
            <td colspan="3">Aucun membre</td>
        </tr>
        <?php } ?>
    </table>
</section>

