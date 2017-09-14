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
        foreach ($result->fetchAll() as $chapter)
        {
            $chaptersList[] = new Chapter($chapter['id'], $chapter['number'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
        }
        $result->closeCursor();
        return $chaptersList;
    }

    public static function find($id)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('SELECT * FROM Chapters WHERE id = :id');
        $result->bindValue(':id', $id);
        $result->execute();
        $chapter = $result->fetch();
        $result->closeCursor();

        return $chapter = new Chapter($chapter['id'], $chapter['number'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
    }

    public static function ifExists(array $column)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('SELECT '.$column['0'].' FROM Chapters WHERE '.$column['0'].' = :col');
        $result->bindValue(':col', $column['1']);
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
        $result = $db->query('SELECT COUNT(*) FROM Chapters');
        $count = $result->fetchColumn();
        $result->closeCursor();

        return $count;
    }
}