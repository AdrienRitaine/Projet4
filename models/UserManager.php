<?php

class UserManager extends Model
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

    // Retourne l'information demander
    public function getInfoUser($pseudo, $password, $info)
    {
        $data = array(
            'pseudo' => $pseudo,
            'password' => $password
        );

        $this->getBdd();
        return $this->getWhereUserInfo('utilisateurs', $data, $info);
    }

    // Retourne l'information demander
    public function getRecovery($email)
    {
        $this->getBdd();
        return $this->getRecoveryId($email);
    }

    // Envoi les données dans la méthode addData()
    public function userRegister($pseudo, $email, $password)
    {
        $data = array(
            'pseudo' => addslashes($pseudo),
            'email' => addslashes($email),
            'motdepasse' => $password,
            'permission' => 0,
            'recovery' => rand(),
            'status' => 0,
            'avatar' => 'default.png'
        );

        $this->getBdd();
        $this->addData('utilisateurs', $data);
    }

    // Vérifie une information dans le base de donnée
    public function verifyInfo($info, $data)
    {
        $this->getBdd();
        return $this->verifyInfomation('utilisateurs', $info, $data);
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

    public function getUsers()
    {
        $this->getBdd();
        return $this->getAll('utilisateurs', 'User');
    }

    public function deleteUser($id)
    {
        $this->getBdd();
        $this->deleteDataByInfo('utilisateurs', 'id', $id);
    }

    public function blockUsers($id)
    {
        $this->getBdd();
        if ($this->verifyInfomationById('utilisateurs', 'status', 0, $id)) {
            $this->updateDataById('utilisateurs', $id, 'status', 1);
        } else {
            $this->updateDataById('utilisateurs', $id, 'status', 0);
        }

    }

    public function updateAvatar($avatar, $id)
    {
        $this->getBdd();
        $this->updateDataById('utilisateurs', $id, 'avatar', $avatar);
    }
}

?>