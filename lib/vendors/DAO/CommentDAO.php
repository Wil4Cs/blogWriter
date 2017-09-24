<?php

namespace DAO;

use Model\Comment;

/**
 * Class CommentDAO
 *
 * @package DAO
 */
class CommentDAO extends DAO
{
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
        $req = $this->_db->prepare('UPDATE comments SET flag = :flag WHERE id = :id');
        // Value 1 means the comment is now warned => flag = TRUE
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->bindValue('flag', '1', \PDO::PARAM_BOOL);
        $req->execute();
        $req->closeCursor();
    }

    public function ifCommentExists($id)
    {
        $req = $this->_db->prepare('SELECT id FROM comments WHERE id = :id');
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->execute();
        // If it's matching, this means that the requested exists and return true or it returns false
        if ($req->fetch() != true) {
            $req->closeCursor();
            return false;
        }
        $req->closeCursor();
        return true;
    }

    public function countFlag()
    {
        $req = $this->_db->query('SELECT COUNT(flag) FROM comments WHERE flag = 1');
        $count = $req->fetchColumn();
        $req->closeCursor();
        return $count;
    }

    public function eraseComment($id)
    {
        $req = $this->_db->prepare('DELETE FROM comments WHERE id = :id');
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function getAllCautionComments()
    {
        $req = $this->_db->query('SELECT * FROM comments WHERE flag = 1');
        $result = $req->fetchAll();
        $cautionCommentsList = array();
        foreach ($result as $dbRow)
        {
            $cautionCommentsList[] = new Comment($dbRow);
        }
        $req->closeCursor();
        return $cautionCommentsList;
    }

    public function getListOfComments($chapter)
    {
        $req = $this->_db->prepare('SELECT * FROM comments WHERE chapter = :chapter ORDER BY id DESC');
        $req->bindValue('chapter', $chapter, \PDO::PARAM_INT);
        $req->execute();
        $commentList = array();
        foreach ($req as $dbRow)
        {
            $commentList[] = new Comment($dbRow);
        }
        $req->closeCursor();
        return $commentList;
    }

    public function refreshComment($id)
    {
        $req = $this->_db->prepare('UPDATE comments SET flag = :flag WHERE id = :id');
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->bindValue('flag', '0', \PDO::PARAM_BOOL);
        $req->execute();
        $req->closeCursor();
    }
}