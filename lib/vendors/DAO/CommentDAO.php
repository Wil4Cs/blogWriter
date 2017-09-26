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
        $req = $this->_db->prepare('INSERT INTO comments SET author = :author, content = :content, chapter_number = :chapterNumber, post_date = NOW()' );
        $req->bindValue('author', $comment->getAuthor());
        $req->bindValue('content', $comment->getContent());
        $req->bindValue('chapterNumber', $comment->getChapterNumber(), \PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function flagComment($id, $value)
    {
        $req = $this->_db->prepare('UPDATE comments SET flag = :flag WHERE id = :id');
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->bindValue('flag', $value, \PDO::PARAM_BOOL);
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

    public function eraseAllComments($chapterNumber)
    {
        $req = $this->_db->prepare('DELETE FROM comments WHERE chapter_number = :chapterNumber');
        $req->bindValue('chapterNumber', $chapterNumber, \PDO::PARAM_INT);
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

    public function getComment($id)
    {
        $req = $this->_db->prepare('SELECT * FROM comments WHERE id = :id');
        $req->bindValue('id', $id, \PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();
        $comment = new Comment($result);
        $req->closeCursor();
        return $comment;
    }

    public function getListOfComments($chapter)
    {
        $req = $this->_db->prepare('SELECT * FROM comments WHERE chapter_number = :chapterNumber ORDER BY id DESC');
        $req->bindValue('chapterNumber', $chapter, \PDO::PARAM_INT);
        $req->execute();
        $commentList = array();
        foreach ($req as $dbRow)
        {
            $commentList[] = new Comment($dbRow);
        }
        $req->closeCursor();
        return $commentList;
    }

    public function updateComment(Comment $comment)
    {
        $req = $this->_db->prepare('UPDATE comments SET author = :author, content = :content, chapter_number = :chapterNumber, post_date = NOW() WHERE id = :id');
        $req->bindValue('author', $comment->getAuthor());
        $req->bindValue('chapterNumber', $comment->getChapterNumber(), \PDO::PARAM_INT);
        $req->bindValue('content', $comment->getContent());
        $req->bindValue('id', $comment->getId(), \PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }
}