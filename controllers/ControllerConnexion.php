<?php

require_once('views/View.php');
require_once('models/ConRegManager.php');
class ControllerConnexion
{
    private $_view;
    private $_con;
    private $_pseudo;
    private $_password;
    private $_email;
    private $_permission;
    private $_errorMsg;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 2)
        {
            throw new Exception('Page introuvable !');
        }
        else if(isset($url) && isset($url[1]))
        {
            if($url[1] === 'login')
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
            else if($url[1] === 'register')
            {
                if(!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email']))
                {
                    $this->userRegister($_POST);
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
            $_SESSION['permission'] = '';
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
       if($this->_con->verifyUser($this->_pseudo, $this->_password)) // Vérification de l'utilisateur
       {
        $this->_permission = $this->_con->getInfoUser($this->_pseudo, $this->_password, 'permission'); // Récupération de la permission
        $_SESSION['pseudo'] = $this->_pseudo;
        $_SESSION['password'] = $this->_password;
        $_SESSION['permission'] = $this->_permission;
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

    // Gestion des inscription
    private function userRegister($array)
    {
        $this->_pseudo = htmlspecialchars($array['pseudo']);
        $this->_email = htmlspecialchars($array['email']);
        $this->_password = sha1(htmlspecialchars($array['password']));

        $this->_con = new conRegManager();
        $this->_con->userRegister($this->_pseudo, $this->_email, $this->_password);
        $this->_errorMsg = "<script> Toast.fire({icon: 'success',  title: 'Inscription réussi !'}) </script>";
        $this->connexion();
    }
}

?>