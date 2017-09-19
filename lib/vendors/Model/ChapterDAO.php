<?php

namespace Model;


use Entity\Chapter;

/**
 * Class ChapterDAO
 *
 * @package Model
 */
class ChapterDAO extends DAO
{
    public function findAllChapters()
    {
        $result = $this->_db->query('SELECT * FROM Chapters ORDER BY id DESC');
        $chaptersList = array();
        $chapters = $result->fetchAll();
        foreach ($chapters as $sqlRow)
        {
            $chaptersList[] = new Chapter($sqlRow);
        }
        $result->closeCursor();
        return $chaptersList;
    }

    public function find($id)
    {
        $result = $this->_db->prepare('SELECT * FROM Chapters WHERE id = :id');
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

        $result = $this->_db->query('SELECT COUNT(id) FROM Chapters');
        $count = $result->fetchColumn();
        $result->closeCursor();
        return $count;
    }
}