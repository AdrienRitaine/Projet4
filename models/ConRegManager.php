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

    public function getInfoUser($pseudo, $password, $info)
    {
        $data = array(
            'pseudo' => $pseudo,
            'password' => $password
        );

        $this->getBdd();
        return $this->getWhereUserInfo('utilisateurs', $data, $info);
    }

    public function userRegister($pseudo, $email, $password)
    {
        $data = array(
            'pseudo' => $pseudo,
            'email' => $email,
            'motdepasse' => $password,
            'permission' => 0,
            'recovery' => rand()
        );

        $this->getBdd();
        $this->addData('utilisateurs', $data);
    }
}

?>