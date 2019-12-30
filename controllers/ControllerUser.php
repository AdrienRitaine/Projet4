<?php

require_once('views/View.php');

class ControllerUser
{
    private $_view;
    private $_con;
    private $_password;
    private $_errorMsg;
    private $_infos;
    private $_recovery;
    private $_id;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 4 || isset($url) && count($url) < 4)
        {
            throw new Exception('Page introuvable !');
        }
        else if(isset($url) && isset($url[1]))
        {
            if($url[1] === 'resetPassword')
            {
                if(!empty($url[2]) && !empty($url[3]))
                {
                    $this->resetPassword($url[2], $url[3]);
                }
                else
                {
                    throw new Exception('Page introuvable !');
                }
            }
            else if($url[1] === 'reset')
            {
                if(!empty($url[2]) && !empty($url[3]))
                {
                    if (!empty($_POST['password']))
                    {
                        $this->reset($url[2], $url[3], $_POST);
                    }
                    else
                    {
                        $this->_errorMsg = "<h2 class=\"error\">Veuillez remplir tout les champs !</h2>";
                        $this->resetPassword($url[2], $url[3]);
                    }
                }
                else
                {
                    throw new Exception('Page introuvable !');
                }
            }
            else
            {
                throw new Exception('Page introuvable !');
            }
        }
        else
        {
            throw new Exception('Page introuvable !');
        }
    }

    private function resetPassword($recovery, $id)
    {
        $this->_recovery = $recovery;
        $this->_id = $id;
        $this->_infos = array('recovery' => $this->_recovery, 'id' => $this->_id, 'error' => $this->_errorMsg);

        $this->_con = new UserManager();
        if($this->_con->recovery_exist( $this->_recovery, $this->_id))
        {
            $this->resetForm();
        }
        else
        {
            throw new Exception('Lien invalide ou expiré !');
        }
    }

    private function resetForm()
    {
        $infos = $this->_infos;
        $this->_view = new View('ResetForm', 0);
        $this->_view->generate(array('infos' => $infos));
    }

    private function reset($recovery, $id, $array)
    {
        $this->_recovery = $recovery;
        $this->_id = $id;
        $this->_password = sha1($array['password']);

        $this->_con = new UserManager();
        if($this->_con->recovery_exist($this->_recovery, $this->_id))
        {
            $this->_con->updatePassword($this->_recovery, $this->_id, $this->_password);
            $errorMsg = '<script> Toast.fire({icon: \'success\',  title: \'Mot de passe changé !\'}) </script>';
            $this->_view = new View('Connexion', 0);
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
        else
        {
            throw new Exception('Lien invalide ou expiré !');
        }

    }
}