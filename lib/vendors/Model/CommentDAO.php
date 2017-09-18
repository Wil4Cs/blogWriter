<?php

namespace Model;

use Entity\Comment;
use Framework\PDOFactory;

class CommentDAO
{
    public static function getListOfComments($chapter)
    {
        $db = PDOFactory::getDb();
        $result = $db->query('SELECT * FROM comments WHERE chapter =' .$chapter. ' ORDER BY id DESC');
        $comments = $result->fetchAll();
        $commentList = array();
        foreach ($comments as $sqlRow)
        {
            $commentList[] = new Comment($sqlRow);
        }
        $result->closeCursor();
        return $commentList;
    }

    public static function addComment(Comment $comment)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('INSERT INTO comments SET author = :author, content = :content, chapter = :chapter, postDate = NOW()' );
        $result->bindValue('author', $comment->getAuthor());
        $result->bindValue('content', $comment->getContent());
        $result->bindValue('chapter', $comment->getChapter(), \PDO::PARAM_INT);
        $result->execute();
        $result->closeCursor();
    }

    public static function cautionComment($id)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('UPDATE comments SET flag = :flag WHERE id = :id');
        $result->bindValue('flag', '1', \PDO::PARAM_BOOL);
        $result->bindValue('id', $id, \PDO::PARAM_INT);
        $result->execute();
        $result->closeCursor();
    }
}