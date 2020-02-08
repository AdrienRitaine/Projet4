<?php

require_once 'views/View.php';

class ControllerPanel
{
    private $_view;
    private $_infos;
    private $_errorMsg;
    private $_con;
    private $_titre;
    private $_contenu;
    private $_auteur;
    
    public function __construct($url)
    {
        if ($url && count($url) > 4) {
            throw new Exception('Page introuvable !');
        } else if (isset($url) && isset($url[1])) {
            if ($url[1] === 'new') {
                $this->new();
            } else if ($url[1] === 'chapitre') {
                $this->panel();
            } else if ($url[1] === 'addChapter') {
                if (isset($_POST['titre']) && !empty($_POST['contenu'])) {
                    $this->addChapter($_POST);
                    echo "success";
                } else {
                    echo "error";
                }
            } else if ($url[1] === 'editChapter') {
                if (isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['id']) && !empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['id'])) {
                    $this->editChapter($_POST);
                    echo "success";
                } else {
                    echo "error";
                }
            } else if ($url[1] === 'delete') {
                if (isset($url[2]) && isset($url[3]) && !empty($url[2]) && !empty($url[3])) {
                    $this->delete($url[2], $url[3]);
                } else {
                    throw new Exception('Page introuvable !! ');
                }
            } else if ($url[1] === 'deleteComment') {
                if (isset($url[2]) && isset($url[3]) && !empty($url[2]) && !empty($url[3])) {
                    $this->deleteComment($url[2], $url[3]);
                } else {
                    throw new Exception('Page introuvable !! ');
                }
            } else if ($url[1] === 'deleteUser') {
                if (isset($url[2]) && isset($url[3]) && !empty($url[2]) && !empty($url[3])) {
                    $this->deleteUser($url[2], $url[3]);
                } else {
                    throw new Exception('Page introuvable !! ');
                }
            } else if ($url[1] === 'blockUser') {
                if (isset($url[2]) && isset($url[3]) && !empty($url[2]) && !empty($url[3])) {
                    $this->blockUser($url[2], $url[3]);
                } else {
                    throw new Exception('Page introuvable !! ');
                }
            } else if ($url[1] === 'acceptComment') {
                if (isset($url[2])) {
                    $this->acceptComment($url[2]);
                } else {
                    throw new Exception('Page introuvable !! ');
                }
            } else if ($url[1] === 'edit') {
                if (isset($url[2])) {
                    $this->edit($url[2]);
                } else {
                    throw new Exception('Page introuvable !! ');
                }
            } else if ($url[1] === 'signalement') {
                $this->signal();
            } else if ($url[1] === 'membres') {
                $this->membres();
            } else {
                throw new Exception('Page introuvable !! ');
            }
        } else {
            $this->panel();
        }
    }

    private function panel()
    {
        if ($_SESSION['permission'] == 1) {
            $this->_con = new ChapitreManager;
            $this->_infos = array('chapitres' => $this->_con->getChapitres(), 'erreur' => $this->_errorMsg);
            $infos = $this->_infos;

            $this->_view = new View('Panel', 1);
            $this->_view->generate(array('infos' => $infos));
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }


    private function new()
    {
        if ($_SESSION['permission'] == 1) {
            $infos = $this->_infos;

            $this->_view = new View('NewChapitre', 1);
            $this->_view->generate(array('infos' => $infos));
        } else {
            throw new Exception('Permission non accordée ! ');
        }

    }

    private function addChapter($array)
    {
        if ($_SESSION['permission'] == 1) {
            $this->_titre = $array['titre'];
            $this->_contenu = $array['contenu'];
            $this->_auteur = $_SESSION['pseudo'];

            $this->_con = new ChapitreManager();

            $data = array(
                'title' => addslashes($this->_titre),
                'content' => addslashes($this->_contenu),
                'date_creation' => date("Y-m-d  H:i:s"),
                'pseudo' => $this->_auteur
            );

            $this->_con->addChapitre($data);

        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function delete($id, $token)
    {
        if ($_SESSION['permission'] == 1) {
            if ($token == $_SESSION['token']) {
                if ($id) {
                    $this->_con = new ChapitreManager();
                    $this->_con->deleteChapter(intval($id));
                    $this->panel();
                } else {
                    throw new Exception('Page introuvable !');
                }
            } else {
                throw new Exception('Token non valide, veuillez-vous reconnectez !');
            }
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function deleteComment($id, $token)
    {
        if ($_SESSION['permission'] == 1) {
            if ($token == $_SESSION['token']) {
                if ($id) {
                    $this->_con = new ChapitreManager();
                    $this->_con->deleteComments('id', intval($id));
                    $this->signal();
                } else {
                    throw new Exception('Page introuvable !');
                }
            } else {
                throw new Exception('Token non valide, veuillez-vous reconnectez !');
            }
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function acceptComment($id)
    {
        if ($_SESSION['permission'] == 1) {
            if ($id) {
                $this->_con = new ChapitreManager();
                $this->_con->signalerComment(intval($id), 0);
                $this->signal();
            } else {
                throw new Exception('Page introuvable !');
            }

        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function edit($id)
    {
        if ($_SESSION['permission'] == 1) {
            if ($id) {
                $this->_con = new ChapitreManager();
                $chapitre = $this->_con->getChapitre($id);
                foreach ($chapitre as $value) {
                    $this->_titre = $value['title'];
                    $this->_contenu = $value['content'];
                }
                $infos = array('titre' => $this->_titre, 'contenu' => $this->_contenu, 'id' => $id);
                $this->_view = new View('EditChapitre', 1);
                $this->_view->generate(array('infos' => $infos));
            } else {
                throw new Exception('Page introuvable !');
            }

        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function editChapter($array)
    {
        if ($_SESSION['permission'] == 1) {
            $this->_titre = $array['titre'];
            $this->_contenu = $array['contenu'];

            $this->_con = new ChapitreManager();

            $data = array(
                'titre' => addslashes($this->_titre),
                'contenu' => addslashes($this->_contenu)
            );

            $this->_con->updateChapitre($data, $array['id']);
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function signal()
    {
        if ($_SESSION['permission'] == 1) {
            $this->_con = new ChapitreManager;
            $this->_infos = array('comments' => $this->_con->getCommentBySignal(), 'erreur' => $this->_errorMsg);
            $infos = $this->_infos;

            $this->_view = new View('Signalement', 1);
            $this->_view->generate(array('infos' => $infos));
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function membres()
    {
        if ($_SESSION['permission'] == 1) {
            $this->_con = new UserManager();
            $this->_infos = array('membres' => $this->_con->getUsers(), 'erreur' => $this->_errorMsg);
            $infos = $this->_infos;

            $this->_view = new View('Membres', 1);
            $this->_view->generate(array('infos' => $infos));
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function deleteUser($id, $token)
    {
        if ($_SESSION['permission'] == 1) {
            if ($token == $_SESSION['token']) {
                if ($id) {
                    $this->_con = new UserManager();
                    $this->_con->deleteUser(intval($id));
                    $this->membres();
                } else {
                    throw new Exception('Page introuvable !');
                }
            } else {
                throw new Exception('Token non valide, veuillez-vous reconnectez !');
            }
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }

    private function blockUser($id, $token)
    {
        if ($_SESSION['permission'] == 1) {
            if ($token == $_SESSION['token']) {
                if ($id) {
                    $this->_con = new UserManager();
                    $this->_con->blockUsers(intval($id));
                    $this->membres();
                } else {
                    throw new Exception('Page introuvable !');
                }
            } else {
                throw new Exception('Token non valide, veuillez-vous reconnectez !');
            }
        } else {
            throw new Exception('Permission non accordée ! ');
        }
    }


}
