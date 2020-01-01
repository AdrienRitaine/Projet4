<?php

class ArticleManager extends Model
{
    public function getArticles()
    {
        $this->getBdd();
        return $this->getAll('articles', 'Article');
    }

    public function addChapitre($data)
    {
        $this->getBdd();
        $this->addData('articles', $data);
    }

    public function deleteChapter($id)
    {
        $this->getBdd();
        $this->deleteDataById('articles', $id);
    }
}

?>