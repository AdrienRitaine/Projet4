<?php

class ConRegManager extends Model
{
    public function verifyUser($pseudo, $password)
    {
        $data = array(
            'pseudo' => $pseudo, 
            'password' => $password
        );

        $this->getBdd();
        return $this->getWhere('utilisateurs', $data);
    }
}

?>