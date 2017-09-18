<?php

namespace Model;


use Framework\PDOFactory;
use Entity\Chapter;

class ChapterDAO
{
    public static function findAllChapters()
    {
        $db = PDOFactory::getDb();
        $result = $db->query('SELECT * FROM Chapters ORDER BY id DESC');
        $chaptersList = array();
        $chapters = $result->fetchAll();
        foreach ($chapters as $sqlRow)
        {
            $chaptersList[] = new Chapter($sqlRow);
        }
        $result->closeCursor();
        return $chaptersList;
    }

    public static function find($id)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('SELECT * FROM Chapters WHERE id = :id');
        $result->bindValue(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        $sqlRow = $result->fetch();
        $result->closeCursor();

        return $chapter = new Chapter($sqlRow);
    }

    public static function ifExists(array $column)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('SELECT '.$column['0'].' FROM Chapters WHERE '.$column['0'].' = :col');
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

    public static function count()
    {
        $db = PDOFactory::getDb();
        $result = $db->query('SELECT COUNT(id) FROM Chapters');
        $count = $result->fetchColumn();
        $result->closeCursor();
        return $count;
    }
}