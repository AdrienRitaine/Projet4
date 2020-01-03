<?php

class Article
{
    private $_id;
    private $_titre;
    private $_contenu;
    private $_date_creation;
    private $_auteur;

    // Constructeur
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // Hydratation
    public function hydrate(array $data)
    {
        
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    // Setter
    public function setId($id)
    {
        $id = (int) $id;

        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setTitre($titre)
    {
        if(is_string($titre))
        {
            $this->_titre = $titre;
        }
    }

    public function setContenu($contenu)
    {
        if(is_string($contenu))
        {
            $this->_contenu = $contenu;
        }  
    }

    public function setDate_Creation($date_creation)
    {
        $this->_date_creation = date('d/m/Y', strtotime($date_creation));
    }

    public function setAuteur($auteur)
    {
        if(is_string($auteur))
        {
            $this->_auteur = $auteur;
        }        
    }

    // Getter
    public function id()
    {
        return $this->_id;
    }
    public function titre()
    {
        return $this->_titre;
    }
    public function contenu()
    {
        return $this->_contenu;
    }
    public function date_creation()
    {
        return $this->_date_creation;
    }
    public function auteur()
    {
        return $this->_auteur;
    }
}

?>