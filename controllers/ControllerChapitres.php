<?php

require_once('views/View.php');

class ControllerChapitres
{
    private $_articleManager;
    private $_view;

    public function __construct($url)
    {
        if($url && count($url) > 1)
        {
            throw new Exception('Page introuvable !');
        }
        else
        {
            $this->chapitres();
        }
    }

    private function chapitres()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();

        $this->_view = new View('Chapitres', 0);
        $this->_view->generate(array('articles' => $articles));
    }
}