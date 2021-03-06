<?php


abstract class Model
{
    private static $_bdd;

    // Instancie la connexion a la bdd
    private static function setBdd()
    {
        require('config.php');
        self::$_bdd = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'] . ";charset=utf8", $db['username'], $db['password']);
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Récupére la connexion a la bdd
    protected function getBdd()
    {
        if (self::$_bdd == null) {
            self::setBdd();
            return self::$_bdd;
        }
    }

    // Récupére toute les données du table
    protected function getAll($table, $obj)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' ORDER BY id DESC');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // Récupére les données d'une table par rapport a l'id
    protected function getRowById($table, $id)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req;
        $req->closeCursor();
    }

    // Ajout de donnée dans la bdd
    protected function addData($table, $array)
    {
        $columns = implode(", ", array_keys($array));
        $escaped_values = array_map(array(self::$_bdd, 'quote'), array_values($array));
        $values = implode(", ", $escaped_values);

        $req = self::$_bdd->prepare("INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")");

        $req->execute();
    }

    // Vérifie une information dans le base de donnée
    protected function verifyInfomation($table, $info, $data)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE ' . $info . '=\'' . $data . '\'');
        $req->execute();
        if ($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        $req->closeCursor();
    }

    // Vérifie une information dans le base de donnée avec l'id en premier parametre
    protected function verifyInfomationById($table, $info, $data, $id)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE id=' . $id . ' AND ' . $info . '=' . $data);
        $req->execute();
        if ($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        $req->closeCursor();
    }

    // Suppresion de données dans la base
    protected function deleteDataByInfo($table, $data, $info)
    {
        $req = self::$_bdd->prepare('DELETE FROM ' . $table . ' WHERE ' . $data . '=' . $info);
        $req->execute();
        $req->closeCursor();
    }

    // Récupére les données selon une information
    protected function getDataByInfo($table, $getData, $data, $info)
    {
        $req = self::$_bdd->prepare('SELECT ' . $getData . ' FROM ' . $table . ' WHERE ' . $data . '=\'' . $info . '\'');
        $req->execute();
        foreach ($req as $reqs) {
            return $reqs['avatar'];
        }

        $req->closeCursor();
    }

    // update par id
    protected function updateDataById($table, $id, $column, $columnData)
    {
        $req = self::$_bdd->prepare('UPDATE ' . $table . ' SET ' . $column . '=\'' . $columnData . '\' WHERE id=' . $id);
        $req->execute();
        $req->closeCursor();
    }

    //----------------------------------------//
    //---------------- CHAPITRE --------------//
    //----------------------------------------//

    protected function updateChapitreById($data, $id)
    {
        $req = self::$_bdd->prepare('UPDATE articles SET title=\'' . $data['titre'] . '\' ,content=\'' . $data['contenu'] . '\'' . 'WHERE id=' . $id);
        $req->execute();
        $req->closeCursor();
    }

    //----------------------------------------//
    //-------------- COMMENTAIRES ------------//
    //----------------------------------------//

    protected function getCommentsById($table, $obj, $id)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE article_id=' . $id);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getCommentsBySignals($table, $obj)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE signals=1');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function signalerCommentById($id, $signal)
    {
        $req = self::$_bdd->prepare('UPDATE comments SET signals=' . $signal . ' WHERE id=' . $id);
        $req->execute();
        $req->closeCursor();
    }

    //----------------------------------------//
    //-------------- UTILISATEUR -------------//
    //----------------------------------------//

    protected function getRecoveryId($email)
    {
        $req = self::$_bdd->prepare("SELECT * FROM users WHERE email='" . $email . "'");
        $req->execute();
        return $req;
        $req->closeCursor();
    }

    protected function verifyRecovery($recovery, $id)
    {
        $req = self::$_bdd->prepare('SELECT * FROM users WHERE id=\'' . $id . '\' AND recovery=\'' . $recovery . '\'');
        $req->execute();
        if ($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        $req->closeCursor();
    }

    protected function resetPassword($recovery, $id, $password)
    {
        $newrecovery = rand();
        $req = self::$_bdd->prepare('UPDATE users SET password=\'' . $password . '\' ,recovery=\'' . $newrecovery . '\'' . 'WHERE id=\'' . $id . '\' AND recovery=\'' . $recovery . '\'');
        $req->execute();
        $req->closeCursor();
    }

    // Renvoi un bool si l'utilisateur existe ou non
    protected function getWhereUser($table, $array)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE pseudo = :pseudo AND password = :password');
        $req->bindValue('pseudo', $array['pseudo'], PDO::PARAM_STR);
        $req->bindValue('password', $array['password'], PDO::PARAM_STR);
        $req->execute();
        if ($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        $req->closeCursor();
    }

    //Retourne une information de l'utilisateur
    protected function getWhereUserInfo($table, $array, $info)
    {
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table . ' WHERE pseudo = :pseudo AND password = :password');
        $req->bindValue('pseudo', $array['pseudo'], PDO::PARAM_STR);
        $req->bindValue('password', $array['password'], PDO::PARAM_STR);
        $req->execute();
        foreach ($req as $donnees) {
            return $donnees[$info];
        }
        $req->closeCursor();
    }
}
