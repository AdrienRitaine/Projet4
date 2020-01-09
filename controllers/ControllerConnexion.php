<?php

require_once 'views/View.php';
require_once('models/UserManager.php');

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
                if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['password']))
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
            else if($url[1] === 'lostpassword')
            {
                $this->lostPassword();
            }
            else if($url[1] === 'lostPassword')
            {
                if(!empty($_POST['email']))
                {
                    $this->lostPasswordMail($_POST);
                }
                else
                {
                    $this->_errorMsg = '<h2 class="error">Veuillez remplir tout les champs !</h2>';
                    $this->lostPassword();
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
        $this->_con = new UserManager();
        if($this->_con->verifyUser($_SESSION['pseudo'], $_SESSION['password']))
        {
            $articleManager = new ArticleManager;
            $articles = $articleManager->getArticles();
            $this->_view = new View('Accueil', 0);
            $this->_view->generate(array('articles' => $articles));
        }
        else
        {
            $errorMsg = $this->_errorMsg;
            $this->_view = new View('Connexion', 0);
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
       $this->_con = new UserManager();
       if($this->_con->verifyUser($this->_pseudo, $this->_password)) // Vérification de l'utilisateur
       {
        $this->_permission = $this->_con->getInfoUser($this->_pseudo, $this->_password, 'permission'); // Récupération de la permission
        $_SESSION['pseudo'] = $this->_pseudo;
        $_SESSION['password'] = $this->_password;
        $_SESSION['permission'] = $this->_permission;
        $_SESSION['connected'] = "yes";
        $_SESSION['token'] = rand();
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

        $this->_con = new UserManager();
        if($this->_con->verifyInfo('pseudo', $this->_pseudo))
        {
            $this->_errorMsg = "<h2 class=\"error\">Pseudo non disponible.</h2>";
            $this->connexion();
        }
        else
        {
            if($this->_con->verifyInfo('email', $this->_email))
            {
                $this->_errorMsg = "<h2 class=\"error\">L'e-mail choisi existe déjà.</h2>";
                $this->connexion();
            }
            else
            {
                $this->_con->userRegister($this->_pseudo, $this->_email, $this->_password);
                $this->_errorMsg = "<script> Toast.fire({icon: 'success',  title: 'Inscription réussi !'}) </script>";
                $this->connexion();
            }
        }
    }

    private function lostPassword()
    {
        $errorMsg = $this->_errorMsg;
        $this->_view = new View('LostPassword', 0);
        $this->_view->generate(array('errorMsg' => $errorMsg));
    }

    private function lostPasswordMail($array)
    {
        require('config.php');
        $this->_email = $array['email'];
        $this->_con = new UserManager();
        if($this->_con->verifyInfo('email', $this->_email))
        {
            foreach($this->_con->getRecovery($this->_email) AS $row)
            {
                $recovery_code = $row['recovery'];
                $id = $row['id'];
                $pseudo = $row['pseudo'];
            }

            $header="MIME-Version: 1.0\r\n";
            $header.='From:"ProjetS2SN"<projets2sn@gmail.com>'."\n";
            $header.='Content-Type:text/html; charset="utf-8"'."\n";
            $header.='Content-Transfert-Encoding: 8bit';

            $message = '
						<html>
							<body>
								<div align="center">
									<strong><h1>Mot de passe oublié</h1></strong>'."\n".
                'Bonjour <strong>'. $pseudo . '</strong> , Veuillez cliquer sur le lien ci-dessous.<br>' ."\n".'
							Lien de réinitialisation : '. $url . "user/resetPassword/". $recovery_code.'/'.$id.'
								</div>
							</body>
						</html>
						';

            mail($this->_email, "Oublie de mot de passe", $message, $header);

            $this->_errorMsg = '<script> Toast.fire({icon: \'success\',  title: \'Lien envoyé par email !\'}) </script>';
            $this->connexion();
        }
        else
        {
            print_r('NON');
        }
    }
}

?>