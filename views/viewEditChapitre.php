<?php


$this->_t = "◄ Modifier le Chapitre ►";
$this->_style = "Panel";
$this->_titre = "Modifier le chapitre";
require('config.php');

?>
<script>
    tinymce.init({selector: 'textarea.tinymce'});

    $(document).ready(function () {
        $("#newChapitre").submit(function (e) {

            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (data) {
                    if (data === "success") {
                        Swal.fire(
                            'Succés !',
                            'Le chapitre a été modifier.',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Oops !',
                            'Veuillez remplir tout les champs.',
                            'error'
                        )
                    }

                }
            });
        });
    });

</script>


<section class="body">
    <form action="<?= $url ?>Panel/editChapter" method="POST" id="newChapitre">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?= $infos['titre'] ?>">
        <label for="tinymce">Chapitre :</label>
        <textarea name="contenu" id="tinymce" cols="30" rows="10" class="tinymce"><?= $infos['contenu'] ?></textarea>
        <input type="hidden" name="id" value="<?= $infos['id'] ?>">
        <input type="submit" class="button" value="MODIFIER">
    </form>
</section>





