<?php

require_once('views/View.php');

class ControllerConnexion
{
    private $_view;
    private $_pseudo;
    private $_password;
    private $_errorMsg;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 2)
        {
            throw new Exception('Page introuvable !');
        }
        else if(isset($url) && isset($url[1]))
        {
            if($url[1] === 'getCon')
            {
                if(!empty($_POST['pseudo'] && !empty($_POST['password'])))
                {
                    $this->getCon($_POST);
                }
                else
                {
                    $this->_errorMsg = '<h2 class="error">Veuillez remplir tout les champs !</h2>';
                    $this->connexion();
                }
            }
            else
            {
                $this->_errorMsg = '<h2 class="error">Le lien demandé n\'existe pas !</h2>';
                $this->connexion();
            }
        }
        else
        {
            $this->connexion();
        }
    }

    private function connexion()
    {
        $errorMsg = $this->_errorMsg;
        $this->_view = new View('Connexion');
        $this->_view->generate(array('errorMsg' => $errorMsg));
    }

    private function getCon($array){
       $this->_pseudo = $array['pseudo'];
       $this->_password = $array['password'];
       print_r($this->_pseudo . ' ' . $this->_password);

    } 
}

?>