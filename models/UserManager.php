<?php

class UserManager extends Model
{

    //----------------------------------------//
    //-------------- UTILISATEUR -------------//
    //----------------------------------------//

    // Envoi les données dans la méthode addData()
    public function userRegister($pseudo, $email, $password)
    {
        $data = array(
            'pseudo' => addslashes($pseudo),
            'email' => addslashes($email),
            'password' => $password,
            'permission' => 0,
            'recovery' => rand(),
            'status' => 0,
            'avatar' => 'default.png'
        );

        $this->getBdd();
        $this->addData('users', $data);
    }

    // Créer un tableau pour traiter les données
    public function verifyUser($pseudo, $password)
    {
        $data = array(
            'pseudo' => $pseudo,
            'password' => $password
        );

        $this->getBdd();
        return $this->getWhereUser('users', $data);
    }

    // Retourne l'information demander
    public function getInfoUser($pseudo, $password, $info)
    {
        $data = array(
            'pseudo' => $pseudo,
            'password' => $password
        );

        $this->getBdd();
        return $this->getWhereUserInfo('users', $data, $info);
    }

    // Retourne l'information demander
    public function getRecovery($email)
    {
        $this->getBdd();
        return $this->getRecoveryId($email);
    }

    public function getUsers()
    {
        $this->getBdd();
        return $this->getAll('users', 'User');
    }

    // Vérifie une information dans le base de donnée
    public function verifyInfo($info, $data)
    {
        $this->getBdd();
        return $this->verifyInfomation('users', $info, $data);
    }

    public function recovery_exist($recovery, $id)
    {
        $this->getBdd();
        return $this->verifyRecovery($recovery, $id);
    }

    public function updatePassword($recovery, $id, $password)
    {
        $this->getBdd();
        $this->resetPassword($recovery, $id, $password);
    }

    public function blockUsers($id)
    {
        $this->getBdd();
        if ($this->verifyInfomationById('users', 'status', 0, $id)) {
            $this->updateDataById('users', $id, 'status', 1);
        } else {
            $this->updateDataById('users', $id, 'status', 0);
        }
    }

    public function updateAvatar($avatar, $id)
    {
        $this->getBdd();
        $this->updateDataById('users', $id, 'avatar', $avatar);
    }

    public function deleteUser($id)
    {
        $this->getBdd();
        $this->deleteDataByInfo('users', 'id', $id);
    }


}
