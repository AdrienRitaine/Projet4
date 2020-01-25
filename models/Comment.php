<?php

class Comment
{
    private $_id;
    private $_pseudo;
    private $_comment;
    private $_date;
    private $_signal;
    private $_id_article;
    private $_con;
    private $_avatar;

    // Constructeur
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // Hydratation
    public function hydrate(array $data)
    {

        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Setter
    public function setId($id)
    {
        $id = (int)$id;

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setPseudo($pseudo)
    {
        if (is_string($pseudo)) {
            $this->_pseudo = $pseudo;
        }
    }

    public function setComment($comment)
    {
        if (is_string($comment)) {
            $this->_comment = stripslashes($comment);
        }
    }

    public function setDate($date)
    {
        $this->_date = date('d/m/Y à H:i:s', strtotime($date));
    }

    public function setSignal($signal)
    {
        if (is_int($signal)) {
            $this->_signal = $signal;
        }
    }

    public function setId_article($id_article)
    {
        if (is_int($id_article)) {
            $this->_id_article = $id_article;
        }
    }

    // Getter
    public function id()
    {
        return $this->_id;
    }

    public function pseudo()
    {
        return $this->_pseudo;
    }

    public function comment()
    {
        return $this->_comment;
    }

    public function date()
    {
        return $this->_date;
    }

    public function signalement()
    {
        return $this->_signalement;
    }

    public function id_article()
    {
        return $this->_id_article;
    }

    public function avatar()
    {
        $this->_con = new ChapitreManager();
        $this->_avatar = $this->_con->getAvatar($this->_pseudo);
        if (empty($this->_avatar)) {
            $this->_avatar = 'default.png';
        }

        return $this->_avatar;
    }
}

?>