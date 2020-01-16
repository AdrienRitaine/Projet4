<?php

require_once 'views/View.php';

class ControllerAccueil
{
    private $_chapitreManager;
    private $_view;

    public function __construct($url)
    {
        if ($url && count($url) > 1) {
            throw new Exception('Page introuvable !');
        } else {
            $this->chapitre();
        }
    }

    private function chapitre()
    {
        $this->_chapitreManager = new ChapitreManager;

        $this->_view = new View('accueil', 0);
        $this->_view->generate(array('chapitres' => $this->_chapitreManager->getChapitres()));
    }
}

?>