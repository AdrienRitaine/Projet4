<?php
$this->_t = "Erreur !";
$this->_style = "Erreur";
require('config.php');

?>

<section class="error404">
    <div class="logo404">
        <h1>4 <i class="fas fa-exclamation-circle"></i> 4</h1>
    </div>
    <h2>PAGE NON TROUVÉE</h2>
    <p>Je pense que vous étes perdu... :)</p>
    <p class="errortype">Type erreur : <?= $errorMsg ?></p>
</section>