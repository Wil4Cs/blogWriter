<?php

namespace Model;


use Framework\PDOFactory;
use Entity\Chapter;

class ChapterDAO
{
    public static function findAllChapters()
    {
        $sql = 'SELECT * FROM Chapters';
        $listChapters = PDOFactory::getDb()->query($sql);
        $list = array();
        foreach ($listChapters->fetchAll() as $chapter)
        {
            $list[] = new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
        }

        return $list;

        /*$list = [];
        $db = PDOFactory::getDb();
        $req = $db->query('SELECT * FROM Chapters');

        // we create a list of Post objects from the database results
        foreach($req->fetchAll() as $chapter)
        {
            $list[] = new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
        }

        return $list;*/
    }

    public static function find($id)
    {
        $db = PDOFactory::getDb();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM Chapters WHERE id = :id');

        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $chapter = $req->fetch();

        return new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
    }
}