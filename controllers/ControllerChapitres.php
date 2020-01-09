<?php

require_once 'views/View.php';

class ControllerChapitres
{
    private $_articleManager;
    private $_view;
    private $_titre;
    private $_contenu;
    private $_auteur;
    private $_date;
    private $_errorMsg;
    private $_comment;
    private $_id;
    private $_con;

    public function __construct($url)
    {
        if($url && count($url) > 3)
        {
            throw new Exception('Page introuvable !');
        }
        else if(isset($url) && isset($url[1]))
        {
            if($url[1] === 'v')
            {
                if (isset($url['2']) && !empty($url['2']))
                {
                    $this->_errorMsg = "";
                    $this->open($url['2']);
                }
                else
                {
                    throw new Exception('Chapitre non trouvé !');
                }
            }
            else if($url[1] === 'comment')
            {
                if (isset($url['2']) && !empty($url['2']))
                {
                    if (!empty($_POST['comment']))
                    {
                        $this->comment($url['2'], $_POST);
                    }
                    else
                    {
                        $this->_errorMsg = 'Veuillez remplir tout les champs';
                        $this->open($url['2']);
                    }
                }
                else
                {
                    throw new Exception('Chapitre non trouvé !');
                }
            }
            else if($url[1] === 'signaler')
            {
                if (isset($url['2']) && !empty($url['2']))
                {
                    echo "success";
                    $this->signaler($url['2']);
                }
                else
                {
                    throw new Exception('Commentaires non trouvé !');
                }
            }
            else
            {
                throw new Exception('Page introuvable !! ');
            }
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

        $this->_view = new View('chapitres', 0);
        $this->_view->generate(array('articles' => $articles));
    }

    private function open($id)
    {
        $this->_con = new ArticleManager();
        $chapitre = $this->_con->getChapitre($id);
        $comment = $this->_con->getComments($id);
        foreach($chapitre as $value)
        {
            $this->_titre = $value['titre'];
            $this->_contenu = $value['contenu'];
            $this->_auteur = $value['auteur'];
            $this->_date = $value['date_creation'];
        }
        $infos = array('titre' => $this->_titre, 'contenu' => $this->_contenu, 'id' => $id, 'auteur' => $this->_auteur, 'date' => $this->_date, 'error' => $this->_errorMsg);
        $this->_view = new View('openChapitre', 0);
        $this->_view->generate(array('infos' => $infos, 'comments' => $comment));
    }

    private function comment($id, $array)
    {
        if($_SESSION['connected'] === 'yes')
        {
            $this->_con = new ArticleManager();

            $data = array(
                'pseudo' => $_SESSION['pseudo'],
                'commentaire' => htmlspecialchars(addslashes($array['comment'])),
                'date' => date("Y-m-d  H:i:s"),
                'signalement' =>  0,
                'id_article' => $id
            );

            $this->_con->addComment($data);
            $this->_errorMsg = '<script>  Swal.fire(
                            \'Succés !\',
                            \'Commentaire envoyé.\',
                            \'success\'
                        )</script>';
            $this->open($id);
        }
        else
        {
            throw new Exception('Connectez-vous !');
        }
    }

    private function signaler($id)
    {
        if($_SESSION['connected'] === 'yes')
        {
            $this->_con = new ArticleManager();
            $this->_con->signalerComment(intval($id),  1);
        }
        else
        {
            throw new Exception('Connectez-vous !');
        }
    }
}