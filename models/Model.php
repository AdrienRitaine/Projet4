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

    protected function getCommentsById($table, $obj, $id)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table. ' WHERE id_article='.$id);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[]= new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getRowById($table, $id)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table. ' WHERE id=' . $id);
        $req->execute();
        return $req;
        $req->closeCursor();
    }

    // Renvoi un bool si l'utilisateur existe ou non
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

    //Retourne une information de l'utilisateur
    protected function getWhereUserInfo($table, $array, $info)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table. ' WHERE pseudo=\''.$array['pseudo'].'\' AND motdepasse=\''.$array['password'].'\'');
        $req->execute();
        foreach($req as $donnees){
            return $donnees[$info];
        }
        $req->closeCursor();
    }

    // Ajout de donnée dans la bdd
    protected function addData($table, $array)
    {
        foreach($array as $key => $value)
        {
            $k[] = $key;
            $v[] = "'" . $value . "'";
        }

        $k = implode(",", $k);
        $v = implode(",", $v);

        $req = self::$_bdd->prepare("INSERT INTO " . $table . " (" . $k . ") VALUES (" . $v . ")");
        $req->execute();
    }

    // Vérifie une information dans le base de donnée
    protected function verifyInfomation($info, $data)
    {
        $req = self::$_bdd->prepare('SELECT * FROM utilisateurs WHERE '.$info.'=\''.$data.'\'');
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

    protected function getRecoveryId($email)
    {
        $req = self::$_bdd->prepare("SELECT * FROM utilisateurs WHERE email='".$email."'");
        $req->execute();
        return $req;
        $req->closeCursor();
    }

    protected function verifyRecovery($recovery, $id)
    {
        $req = self::$_bdd->prepare('SELECT * FROM utilisateurs WHERE id=\''.$id.'\' AND recovery=\''.$recovery.'\'');
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

    protected function resetPassword($recovery, $id, $password)
    {
        $newrecovery = rand();
        $req = self::$_bdd->prepare('UPDATE utilisateurs SET motdepasse=\'' . $password . '\' ,recovery=\'' . $newrecovery. '\'' .'WHERE id=\''. $id .'\' AND recovery=\'' . $recovery . '\'');
        $req->execute();
        $req->closeCursor();
    }

    protected function deleteDataById($table, $id)
    {
        $req = self::$_bdd->prepare('DELETE FROM ' . $table . ' WHERE id=' . $id);
        $req->execute();
        $req->closeCursor();
    }

    protected function updateChapitreById($data, $id)
    {
        $req = self::$_bdd->prepare('UPDATE articles SET titre=\'' . $data['titre'] . '\' ,contenu=\'' . $data['contenu']. '\'' .'WHERE id='. $id);
        $req->execute();
        $req->closeCursor();
    }

    protected function signalerCommentById($id)
    {
        $req = self::$_bdd->prepare('UPDATE commentaires SET signalement=1' . ' WHERE id='. $id);
        $req->execute();
        $req->closeCursor();
    }
}

?>