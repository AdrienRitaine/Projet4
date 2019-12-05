<?php

require_once('views/View.php');

class ControllerConnexion
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
        {
            throw new Exception('Page introuvable !');
        }
        else
        {
            $this->connexion();
        }
    }

    private function connexion()
    {
        $this->_view = new View('Connexion');
        $this->_view->generate(array('connexion' => ''));
    }

    
}

?>