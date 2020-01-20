<?php

require_once 'views/View.php';

class ControllerProfil
{
    private $_view;
    private $_errorMsg;
    private $_infos;
    private $_con;
    private $_recovery;
    private $_passwordConfirm;
    private $_password;
    private $_pseudo;

    public function __construct($url)
    {
        $this->_pseudo = filter_var($_SESSION['pseudo'], FILTER_SANITIZE_STRING);
        $this->_password = filter_var($_SESSION['password'], FILTER_SANITIZE_STRING);

        if ($url && count($url) > 4) {
            throw new Exception('Page introuvable !');
        } else if (isset($url) && isset($url[1])) {
            if ($url[1] === 'edit') {
                if (isset($url[2]) && !empty($url[2])) {
                    $this->profil();
                } else {
                    throw new Exception('Profil non trouvé !');
                }
            } else if ($url[1] === 'avatar') {
                if (isset($url[2]) && !empty($url[2])) {
                    if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
                        $this->avatar($_FILES['avatar'], $url[3]);
                    } else {
                        throw new Exception('Une erreur est survenue !');
                    }
                } else {
                    throw new Exception('Profil non trouvé !');
                }
            } else if ($url[1] === 'delete') {
                if (isset($url[2]) && !empty($url[2])) {
                    if (isset($url[3]) && !empty($url[3])) {
                        $this->deleteUser($url[2], $url[3]);
                    } else {
                        throw new Exception('Une erreur est survenue !');
                    }
                } else {
                    throw new Exception('Profil non trouvé !');
                }
            } else if ($url[1] === 'password') {
                if (isset($url[2]) && !empty($url[2])) {
                    if (!empty($_POST['password'])) {
                        $this->reset($url[2], $_POST, $url[3]);
                    } else {
                        $this->_errorMsg = "<script>  Swal.fire(
                            'Oops !',
                            'Veuillez remplir les champs.',
                            'error'
                        )</script>";
                        $this->profil();
                    }
                } else {
                    throw new Exception('Page introuvable !');
                }
            } else {
                throw new Exception('Page introuvable !! ');
            }
        } else {
            throw new Exception('Page introuvable !! ');
        }
    }

    private function profil()
    {
        if (filter_var($_SESSION['connected'] == "yes")) {
            $this->_con = new UserManager();
            $this->_infos = array(
                'avatar' => $this->_con->getInfoUser($this->_pseudo, $this->_password, 'avatar'),
                'email' => $this->_con->getInfoUser($this->_pseudo, $this->_password, 'email'),
                'id' => $this->_con->getInfoUser($this->_pseudo, $this->_password, 'id'),
                'pseudo' => $_SESSION['pseudo'],
                'error' => $this->_errorMsg
            );


            $this->_view = new View('profil', 0);
            $this->_view->generate(array('infos' => $this->_infos));
        } else {
            throw new Exception('Veuillez vous connecté !');
        }

    }

    private function avatar($array, $token)
    {
        if ($_SESSION['connected'] === "yes") {
            if ($token == $_SESSION['token']) {
                $size = 2097152;
                $extensions = array('jpg', 'jpeg', 'gif', 'png');
                if ($array['size'] < $size) {
                    $extensionsUpload = strtolower(substr(strrchr($array['name'], '.'), 1));
                    if (in_array($extensionsUpload, $extensions)) {
                        $this->_con = new UserManager();
                        $avatarUser = $this->_con->getInfoUser($this->_pseudo, $this->_password, 'id') . '.' . $extensionsUpload;
                        $folderAvatar = 'assets/img/avatars/' . $avatarUser;
                        $result = move_uploaded_file($array['tmp_name'], $folderAvatar);
                        if ($result) {
                            $this->_con->updateAvatar($avatarUser, $this->_con->getInfoUser($this->_pseudo, $this->_password, 'id'));
                            $this->profil();
                        } else {
                            $this->_errorMsg = "<script>  Swal.fire(
                            'Oops !',
                            'Erreur durant l\'upload.',
                            'error'
                        )</script>";
                            $this->profil();
                        }
                    } else {
                        $this->_errorMsg = "<script>  Swal.fire(
                            'Oops !',
                            'Extension non valide (jpg, jpeg, gif, png).',
                            'error'
                        )</script>";
                        $this->profil();
                    }
                } else {
                    $this->_errorMsg = "<script>  Swal.fire(
                            'Oops !',
                            'Image trop volumineuse (max 2mo).',
                            'error'
                        )</script>";
                    $this->profil();
                }
            } else {
                throw new Exception('Une erreur est survenue, veuillez-vous reconnecté !');
            }
        } else {
            throw new Exception('Veuillez-vous reconnecté.');
        }
    }

    private function reset($id, $array, $token)
    {
        if ($_SESSION['connected'] === "yes") {
            if ($token == $_SESSION['token']) {
                $this->_con = new UserManager();
                $this->_recovery = $this->_con->getInfoUser($this->_pseudo, $this->_password, 'recovery');
                $this->_id = $id;
                $this->_password = sha1($array['password']);
                $this->_passwordConfirm = sha1($array['passwordConfirm']);

                if ($this->_password === $this->_passwordConfirm) {
                    $this->_con = new UserManager();
                    $this->_con->updatePassword($this->_recovery, $this->_id, $this->_password);
                    $_SESSION['password'] = sha1($array['password']);
                    $this->_errorMsg = '<script> Toast.fire({icon: \'success\',  title: \'Mot de passe changé !\'}) </script>';
                    $this->profil();
                } else {
                    $this->_errorMsg = "<h2 class=\"error\">Les mots de passe ne sont pas identiques&nbsp;!</h2>";
                    $this->profil();
                }
            } else {
                throw new Exception('Une erreur est survenue, veuillez-vous reconnecté !');
            }

        } else {
            throw new Exception('Veuillez vous connecté !');
        }
    }

    private function deleteUser($id, $token)
    {
        if ($_SESSION['connected'] === "yes") {
            if ($token == $_SESSION['token']) {
                if ($id) {
                    $this->_con = new UserManager();
                    $this->_con->deleteUser(intval($id));
                    $this->_con = new ChapitreManager();
                    $this->_con->deleteComments('id_pseudo', intval($id));
                    $_SESSION['pseudo'] = '';
                    $_SESSION['password'] = '';
                    $_SESSION['connected'] = '';
                    $_SESSION['permission'] = 0;
                    header('Location: /projet4/connexion');
                    exit();
                } else {
                    throw new Exception('Page introuvable !');
                }
            } else {
                throw new Exception('Token non valide, veuillez-vous reconnectez !');
            }
        } else {
            throw new Exception('Veuillez-vous connecté ! ');
        }
    }
}