<?php

require_once('views/View.php');

class ControllerPanel
{
    private $_view;
    private $_infos;

    public function __construct($url)
    {
        if($url && count($url) > 2)
        {
            throw new Exception('Page introuvable !');
        }
        else
        {
            $this->panel();
        }
    }

    private function panel()
    {
        if ($_SESSION['permission'] == 1)
        {
            $infos = $this->_infos;
            $this->_view = new View('Panel', 1);
            $this->_view->generate(array('infos' => $infos));
        }
        else
        {
            throw new Exception('Permission non accordée ! ');
        }

    }
}