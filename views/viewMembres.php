<?php

$this->_t = "◄ Panel d'administration ►";
$this->_style = "Panel";
$this->_titre = "Membres";
require('config.php');

?>

<section class="body">
    <table>
        <thead>
        <tr>
            <th>PSEUDO</th>
            <th>EMAIL</th>
            <th>ACTION</th>
            <th>STATUS</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($infos['membres'])) { ?>
            <?php foreach ($infos['membres'] as $membre): ?>
                <tr>
                    <td><?= $membre->pseudo() ?></td>
                    <td><?= $membre->email() ?></td>
                    <td class="action">
                        <?php if ($membre->permission() == false) { ?>
                            <a href="<?= $url ?>Panel/deleteUser/<?= $membre->id() ?>/<?= $_SESSION['token'] ?>"><i
                                        class="fas fa-trash-alt"></i></a>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($membre->permission() == false) { ?>
                            <a href="<?= $url ?>Panel/blockUser/<?= $membre->id() ?>/<?= $_SESSION['token'] ?>"
                               class="ban"><?php if ($membre->status() == 0) { ?>Bloqué <?php } else { ?> Débloqué <?php } ?>
                                <i class="fas fa-ban"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php } else { ?>
            <tr>
                <td colspan="3">Aucun membre</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

