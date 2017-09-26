<?php

namespace DAO;

use Model\Chapter;

/**
 * Class ChapterDAO
 *
 * @package DAO
 */
class ChapterDAO extends DAO
{
    public function addChapter(Chapter $chapter)
    {
        $req = $this->_db->prepare('INSERT INTO chapters SET author = :author, content = :content, title = :title, chapterNumber = :chapterNumber, postDate = NOW()' );
        $req->bindValue('author', $chapter->getAuthor());
        $req->bindValue('chapterNumber', $chapter->getChapterNumber(), \PDO::PARAM_INT);
        $req->bindValue('content', $chapter->getContent());
        $req->bindValue('title', $chapter->getTitle());
        $req->execute();
        $req->closeCursor();
        return $lastId = $this->_db->lastInsertId();
    }

    public function count()
    {
        $req = $this->_db->query('SELECT COUNT(id) FROM chapters');
        $count = $req->fetchColumn();
        $req->closeCursor();
        return $count;
    }

    public function deleteChapter($id)
    {
        $req = $this->_db->prepare('DELETE FROM chapters WHERE id = :id');
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function find($id)
    {
        $req = $this->_db->prepare('SELECT * FROM chapters WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();
        $req->closeCursor();
        return $chapter = new Chapter($result);
    }

    public function findAllChapters()
    {
        $req = $this->_db->query('SELECT * FROM chapters ORDER BY chapterNumber DESC');
        $chaptersList = array();
        $result = $req->fetchAll();
        foreach ($result as $dbRow)
        {
            $chaptersList[] = new Chapter($dbRow);
        }
        $req->closeCursor();
        return $chaptersList;
    }

    public function ifChapterExists(array $column)
    {
        $req = $this->_db->prepare('SELECT '.$column['0'].' FROM chapters WHERE '.$column['0'].' = :number');
        $req->bindValue(':number', $column['1'], \PDO::PARAM_INT);
        $req->execute();
        // If it's matching, this means that the requested exists and return true or it returns false
        if ($req->fetch() != true) {
            $req->closeCursor();
            return false;
        }
        $req->closeCursor();
        return true;
    }
}