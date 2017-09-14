<?php
/**
 * Created by PhpStorm.
 * User: wilfriedcottineau
 * Date: 13/09/2017
 * Time: 10:54
 */

namespace Model;

use Entity\Comment;
use Framework\PDOFactory;

class CommentDAO
{
    public static function getListOf($chapter)
    {
        $db = PDOFactory::getDb();
        $result = $db->query('SELECT * FROM comments WHERE chapter =' .$chapter. ' ORDER BY id DESC');
        $comments = $result->fetchAll();
        $commentList = array();
        foreach ($comments as $comment)
        {
            $commentList[] = new Comment($comment['id'], $comment['author'], $comment['content'], $comment['postDate'], $comment['chapter'], $comment['flag']);
        }
        $result->closeCursor();
        return $commentList;
    }

    public static function addComment($author, $content, $chapter)
    {
        $db = PDOFactory::getDb();
        $result = $db->prepare('INSERT INTO comments SET author = :author, content = :content, chapter = :chapter, postDate = NOW()' );
        $result->bindValue('author', $author);
        $result->bindValue('content', $content);
        $result->bindValue('chapter', $chapter);
        $result->execute();
        $result->closeCursor();
    }
}