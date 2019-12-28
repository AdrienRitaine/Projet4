<?php

require_once('views/View.php');

class ControllerPanel
{
    private $_view;

    public function __construct($url)
    {
        if($url && count($url) > 1)
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
        print_r('PANEL');
    }
}