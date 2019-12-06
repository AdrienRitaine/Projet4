<?php

class ConRegManager extends Model
{

    // Créer un tableau pour traiter les données
    public function verifyUser($pseudo, $password)
    {
        $data = array(
            'pseudo' => $pseudo, 
            'password' => $password
        );

        $this->getBdd();
        return $this->getWhereUser('utilisateurs', $data);
    }
}

?>