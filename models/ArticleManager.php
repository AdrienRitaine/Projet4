<?php

class ArticleManager extends Model
{
    public function getArticles()
    {
        $this->getBdd();
        return $this->getAll('articles', 'Article');
    }

    public function getComments($id)
    {
        $this->getBdd();
        return $this->getCommentsById('commentaires', 'Comment', $id);
    }

    public function getChapitre($id)
    {
        $this->getBdd();
        return $this->getRowById('articles', $id);
    }

    public function addChapitre($data)
    {
        $this->getBdd();
        $this->addData('articles', $data);
    }

    public function addComment($data)
    {
        $this->getBdd();
        $this->addData('commentaires', $data);
    }

    public function signalerComment($id)
    {
        $this->getBdd();
        $this->signalerCommentById($id);
    }

    public function deleteChapter($id)
    {
        $this->getBdd();
        $this->deleteDataById('articles', $id);
    }

    public function updateChapitre($data, $id)
    {
        $this->getBdd();
        $this->updateChapitreById($data, $id);
    }
}

?>