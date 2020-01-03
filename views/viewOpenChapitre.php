<?php

$this->_t = "Accueil";
$this->_style = "Panel";
require('config.php');

?>

<script>
    $(document).ready(function(){
        $(".url").click(function(e) {

            var id = $(this).attr('value');
            var url = "<?= $url ?>Chapitres/signaler/"+id;

            $.ajax({
                type: "POST",
                url: url,
                success: function(data)
                {
                    if(data === "success")
                    {
                        Swal.fire(
                            'Succés !',
                            'Commentaire signalé.',
                            'success'
                        )
                    }
                    else
                    {
                        Swal.fire(
                            'Oops !',
                            'Une erreur est survenue.',
                            'error'
                        )
                    }

                }
            });
        });
    });
</script>

<section class="section">
    <div class="showChapitre">
        <h2><?= $infos['titre'] ?></h2>
        <?= $infos['contenu'] ?>
        <i><p class="date">Publié le <?=  date('d/m/Y à H:i:s', strtotime($infos['date'])) ?> par <b><?= $infos['auteur'] ?></b></p></i>
        <hr>
        <?php if($_SESSION['connected'] === 'yes'){ ?>
        <form action="<?= $url ?>Chapitres/comment/<?= $infos['id'] ?>" method="POST">
            <textarea placeholder="Envoyer un commentaire" name="comment"></textarea>
            <input type="submit" name="envoyer" value="ENVOYER">
        </form>
            <?= $infos['error'] ?>
        <?php }else{ ?>
            <p class="chapitreP"><i class="fas fa-exclamation-circle"></i> Pour commenter, connectes-toi ! <a href="<?= $url ?>connexion" >Allez se connecter.</a></p>
        <?php }?>
        <p><i class="fas fa-comments"></i><b> Commentaires :</b></p>
        <?php foreach($comments as $comment): ?>
        <div class="commentaire">
            <div class="signal">
                <p><b><?= $comment->pseudo() ?> :   </b></p>
                <?php if($_SESSION['connected'] === 'yes'){ ?>
                    <a class="url" value="<?= $comment->id() ?>"><i class="fas fa-exclamation-triangle"></i></a>
                <?php } ?>
            </div>
            <p><?= $comment->commentaire() ?></p>
            <p><i><b>Le <?= $comment->date() ?></b></i></p>
            <hr>
        </div>
        <?php endforeach; ?>
    </div>
</section>



