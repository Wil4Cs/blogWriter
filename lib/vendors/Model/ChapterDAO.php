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
            $chaptersList[] = new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
        }
        $result->closeCursor();

        return $chaptersList;
    }

    public static function find($id)
    {
        $db = PDOFactory::getDb();
        // we make sure $id is an integer
        $id = intval($id);
        $result = $db->prepare('SELECT * FROM Chapters WHERE id = :id');
        $result->bindValue(':id', $id);
        $result->execute();

        $chapter = $result->fetch();
        $result->closeCursor();

        return $chapter = new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
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