<?php

require_once 'views/View.php';

class ControllerChapitres
{
    private $_articleManager;
    private $_view;
    private $_titre;
    private $_content;
    private $_auteur;
    private $_date;
    private $_avatar;
    private $_errorMsg;
    private $_con;

    public function __construct($url)
    {
        if ($url && count($url) > 4) {
            throw new Exception('Page introuvable !');
        } else if (isset($url) && isset($url[1])) {
            if ($url[1] === 'v') {
                if (isset($url['2']) && !empty($url['2'])) {
                    $this->_errorMsg = "";
                    $this->open($url['2']);
                } else {
                    throw new Exception('Chapitre non trouvé !');
                }
            } else if ($url[1] === 'comment') {
                if (isset($url['2']) && !empty($url['2'])) {
                    if (!empty($_POST['comment'])) {
                        $this->comment($url['2'], $_POST, $url[3]);
                    } else {
                        $this->_errorMsg = 'Veuillez remplir tout les champs';
                        $this->open($url['2']);
                    }
                } else {
                    throw new Exception('Chapitre non trouvé !');
                }
            } else if ($url[1] === 'signaler') {
                if (isset($url['2']) && !empty($url['2'])) {
                    echo "success";
                    $this->signaler($url['2']);
                } else {
                    throw new Exception('Commentaires non trouvé !');
                }
            } else {
                throw new Exception('Page introuvable !! ');
            }
        } else {
            $this->chapitres();
        }
    }

    private function chapitres()
    {
        $this->_articleManager = new ChapitreManager;

        $this->_view = new View('chapitres', 0);
        $this->_view->generate(array('chapitres' => $this->_articleManager->getChapitres()));
    }

    private function open($id)
    {
        $this->_con = new ChapitreManager();
        $chapitre = $this->_con->getChapitre($id);
        $comment = $this->_con->getComments($id);
        foreach ($chapitre as $value) {
            $this->_titre = $value['title'];
            $this->_content = $value['content'];
            $this->_auteur = $value['pseudo'];
            $this->_date = $value['date_creation'];
        }
        $infos = array('titre' => $this->_titre, 'contenu' => $this->_content, 'id' => $id, 'auteur' => $this->_auteur, 'date' => $this->_date, 'error' => $this->_errorMsg);
        $this->_view = new View('openChapitre', 0);
        $this->_view->generate(array('infos' => $infos, 'comments' => $comment));
    }

    private function comment($id, $array, $token)
    {
        if ($_SESSION['connected'] === 'yes') {
            if ($token == $_SESSION['token']) {
                $this->_con = new UserManager();
                $data = array(
                    'pseudo' => $_SESSION['pseudo'],
                    'comment' => htmlspecialchars(addslashes($array['comment'])),
                    'date' => date("Y-m-d  H:i:s"),
                    'signals' => 0,
                    'article_id' => $id,
                    'pseudo_id' => $this->_con->getInfoUser($_SESSION['pseudo'], $_SESSION['password'], 'id'),
                );
                $this->_con = new ChapitreManager();
                $this->_con->addComment($data);
                $this->_errorMsg = "<script>  Swal.fire(
                            'Succés !',
                            'Commentaire envoyé.',
                            'success'
                        )</script>";
                $this->open($id);
            } else {
                throw new Exception('Une erreur est survenue, veuillez-vous reconnecté !');
            }
        } else {
            throw new Exception('Connectez-vous !');
        }
    }

    private function signaler($id)
    {
        if ($_SESSION['connected'] === 'yes') {
            $this->_con = new ChapitreManager();
            $this->_con->signalerComment(intval($id), 1);
        } else {
            throw new Exception('Connectez-vous !');
        }
    }
}