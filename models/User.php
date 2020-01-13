<?php

class User
{
    private $_id;
    private $_pseudo;
    private $_email;
    private $_status;

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

    public function setEmail($email)
    {
        if (is_string($email)) {
            $this->_email = $email;
        }
    }

    public function setStatus($status)
    {
        $status = (int)$status;

        $this->_status = $status;
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

    public function email()
    {
        return $this->_email;
    }

    public function status()
    {
        return $this->_status;
    }
}

?>