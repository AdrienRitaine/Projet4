<?php

abstract class Model
{
    private static $_bdd;

    // Instancie la connexion a la bdd
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } 

    // Récupére la connexion a la bdd
    protected function getBdd()
    {
        if(self::$_bdd == null)
        {
            self::setBdd();
            return self::$_bdd;
        }
    }

    protected function getAll($table, $obj)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table. ' ORDER BY id desc');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[]= new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // Renvoi un bool si l'utilisateur exister ou non
    protected function getWhereUser($table, $array)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table. ' WHERE pseudo=\''.$array['pseudo'].'\' AND motdepasse=\''.$array['password'].'\'');
        $req->execute();
        if($req->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        $req->closeCursor();
    }
}

?>