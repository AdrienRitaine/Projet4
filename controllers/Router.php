<?php

require_once('views/View.php');
session_start();

if(empty($_SESSION['pseudo']) AND empty($_SESSION['password']) AND empty($_SESSION['connected'])){
    $_SESSION['pseudo'] ='';
    $_SESSION['password'] = '';
    $_SESSION['connected'] = '';
}


class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try
        {
            // Chargement automatique des classes.
            function chargerClasse($classe)
            {
            require 'models/'.$classe.'.php';
            }
            spl_autoload_register('chargerClasse');


            $url = '';

            // Choix du controller par rapport a l'url
            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.'.php';
                if(file_exists($controllerFile))
                {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else
                {
                    throw new Exception("Page introuvable !!");
                }
            }
            else
            {
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }

        // Gestion des erreurs
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error' , 0);
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}

?>