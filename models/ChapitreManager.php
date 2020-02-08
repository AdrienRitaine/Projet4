<?php

class ChapitreManager extends Model
{

    //----------------------------------------//
    //---------------- CHAPITRE --------------//
    //----------------------------------------//

    public function addChapitre($data)
    {
        $this->getBdd();
        $this->addData('articles', $data);
    }

    // Récupére tout les chapitres
    public function getChapitres()
    {
        $this->getBdd();
        return $this->getAll('articles', 'Chapitre');
    }

    // Récupére un seul chapitre
    public function getChapitre($id)
    {
        $this->getBdd();
        return $this->getRowById('articles', $id);
    }

    public function updateChapitre($data, $id)
    {
        $this->getBdd();
        $this->updateChapitreById($data, $id);
    }

    public function deleteChapter($id)
    {
        $this->getBdd();
        $this->deleteDataByInfo('articles', 'id', $id);
    }



    //----------------------------------------//
    //-------------- COMMENTAIRES ------------//
    //----------------------------------------//

    public function addComment($data)
    {
        $this->getBdd();
        $this->addData('comments', $data);
    }

    public function getAvatar($pseudo)
    {
        $this->getBdd();
        return $this->getDataByInfo('users', 'avatar', 'pseudo', $pseudo);
    }

    public function getComments($id)
    {
        $this->getBdd();
        return $this->getCommentsById('comments', 'Comment', $id);
    }

    public function getCommentBySignal()
    {
        $this->getBdd();
        return $this->getCommentsBySignals('comments', 'Comment');
    }

    public function signalerComment($id, $signal)
    {
        $this->getBdd();
        $this->signalerCommentById($id, $signal);
    }

    public function deleteComments($data, $info)
    {
        $this->getBdd();
        $this->deleteDataByInfo('comments', $data, $info);
    }

}

