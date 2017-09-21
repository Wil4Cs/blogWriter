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
    public function findAllChapters()
    {
        $result = $this->_db->query('SELECT * FROM chapters ORDER BY id DESC');
        $chaptersList = array();
        $chapters = $result->fetchAll();
        foreach ($chapters as $dbRow)
        {
            $chaptersList[] = new Chapter($dbRow);
        }
        $result->closeCursor();
        return $chaptersList;
    }

    public function find($id)
    {
        $result = $this->_db->prepare('SELECT * FROM chapters WHERE id = :id');
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        $dbRow = $result->fetch();
        $result->closeCursor();
        return $chapter = new Chapter($dbRow);
    }

    public function ifExists(array $column)
    {
        $result = $this->_db->prepare('SELECT '.$column['0'].' FROM Chapters WHERE '.$column['0'].' = :col');
        $result->bindValue(':col', $column['1'], \PDO::PARAM_INT);
        $result->execute();
        // If it's matching, this means that the requested exists and return true or it returns false
        if ($result->fetch() == false) {
            $result->closeCursor();
            return false;
        }
        $result->closeCursor();

        return true;
    }

    public function count()
    {

        $result = $this->_db->query('SELECT COUNT(id) FROM chapters');
        $count = $result->fetchColumn();
        $result->closeCursor();
        return $count;
    }
}