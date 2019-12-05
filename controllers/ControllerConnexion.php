<?php

require_once('views/View.php');

class ControllerConnexion
{
    private $_view;
    
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
                $this->getCon($_POST);
            }
            else
            {
                throw new Exception('Page introuvable !');
            }
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

    private function getCon($array){
       print_r($array);
    } 
}

?>