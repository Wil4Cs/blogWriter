<?php

namespace Model;


use Entity\Comment;

/**
 * Class CommentDAO
 *
 * @package Model
 */
class CommentDAO extends DAO
{
    public function getListOfComments($chapter)
    {
        $result = $this->_db->prepare('SELECT * FROM comments WHERE chapter = :chapter ORDER BY id DESC');
        $result->bindValue('chapter', $chapter, \PDO::PARAM_INT);
        $result->execute();
        $commentList = array();
        foreach ($result as $dbRow)
        {
            $commentList[] = new Comment($dbRow);
        }
        $result->closeCursor();
        return $commentList;
    }

    public function addComment(Comment $comment)
    {
        $result = $this->_db->prepare('INSERT INTO comments SET author = :author, content = :content, chapter = :chapter, postDate = NOW()' );
        $result->bindValue('author', $comment->getAuthor());
        $result->bindValue('content', $comment->getContent());
        $result->bindValue('chapter', $comment->getChapter(), \PDO::PARAM_INT);
        $result->execute();
        $result->closeCursor();
    }

    public function cautionComment($id)
    {
        $result = $this->_db->prepare('UPDATE comments SET flag = :flag WHERE id = :id');
        $result->bindValue('flag', '1', \PDO::PARAM_BOOL);
        $result->bindValue('id', $id, \PDO::PARAM_INT);
        $result->execute();
        $result->closeCursor();
    }
}