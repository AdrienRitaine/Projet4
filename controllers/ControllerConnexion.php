<?php

require_once('views/View.php');
require_once('models/ConRegManager.php');
class ControllerConnexion
{
    private $_view;
    private $_con;
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
                if(!empty($_POST['pseudo']) && !empty($_POST['password']))
                {
                    $this->getCon($_POST);
                }
                else
                {
                    $this->_errorMsg = '<h2 class="error">Veuillez remplir tout les champs !</h2>';
                    $this->connexion();
                }
            }
            else if($url[1] === 'deconnexion')
            {
                $this->deconnexion();
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

    // Envoi vers la vue approprié 
    private function connexion()
    {
        $this->_con = new conRegManager();
        if($this->_con->verifyUser($_SESSION['pseudo'], $_SESSION['password']))
        {
            $articleManager = new ArticleManager;
            $articles = $articleManager->getArticles();
            $this->_view = new View('Accueil');
            $this->_view->generate(array('articles' => $articles));
        }
        else
        {
            $errorMsg = $this->_errorMsg;
            $this->_view = new View('Connexion');
            $this->_view->generate(array('errorMsg' => $errorMsg));
            
        }
        
    }

    // Gestion de la déconnexion
    private function deconnexion()
    {
        if(isset($_SESSION))
        {
            $_SESSION['pseudo'] = '';
            $_SESSION['password'] = '';
            $_SESSION['connected'] = "no";
            $this->connexion();
        }
        else
        {
            $this->connexion();
        }       
    }

    // Gestion de la connexion 
    private function getCon($array){
       $this->_pseudo = htmlspecialchars($array['pseudo']); 
       $this->_password = sha1(htmlspecialchars($array['password']));
       $this->_con = new conRegManager();
       if($this->_con->verifyUser($this->_pseudo, $this->_password))
       {
        $_SESSION['pseudo'] = $this->_pseudo;
        $_SESSION['password'] = $this->_password;
        $_SESSION['connected'] = "yes";
        $this->_errorMsg = '<h2 class="error">Vous étes connecter !</h2>';
        $this->connexion();
       }
       else
       {
        $this->_errorMsg = '<h2 class="error">Mot de passe ou pseudo incorrect !</h2>';
        $this->connexion();
       }

    } 
}

?>