<?php

namespace Controller;

use DAO\CommentDAO;
use Model\Comment;

/**
 * Class PagesController
 */
class FrontController extends MainController
{
    public function error()
    {
        require_once('../views/front/error.php');
        exit();
    }

    public function index()
    {
        $this->wrapChaptersContent('450');
        $this->sendPage();
    }

    public function comment()
    {
        // Guess if the form comment comes from Front(add a comment) or Back(edit a comment)
        if(empty($_GET['id'])) {
            $id = $_POST['chapter'];
        } else {
            $id = $_GET['id'];
        }
        // Check if the chapter exists OR we return the error page
        if ($chapterDAO = $this->chapterExists('id', $id)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Request method is POST so we need to insert a comment
                $this->postCommentForm();
                // Redirect browser to the correct show page
                header('Location: ?controller=front&action=show&id=' .$id);
            }
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Request method is GET so we need to post up the form
                $this->getCommentForm();
            }
        }
    }

    public function show()
    {
        // Check if the chapter exists. It constructs a Chapter object
        if ($chapterDAO = $this->chapterExists('id', $_GET['id'])) {
            // Find the chapter to show
            $chapter = $chapterDAO->find($_GET['id']);

            // Check if a comment has just been mention & constructs a Comment object
            $commentDAO = $this->cautionComment();

            // Get all chapter's comments
            $comments = $commentDAO->getListOfComments($_GET['id']);

            // Construct page to return
            $this->page->setViewsVars('chapter', $chapter);
            $this->page->setViewsVars('comments', $comments);
            $this->sendPage();
        }
    }

    private function addComment()
    {
        $commentDAO = new CommentDAO();
        $comment = new Comment([
            'chapter'   => $_GET['id'],
            'author'    => $_POST['pseudo'],
            'content'   => $_POST['commentContent']
        ]);
        $commentDAO->addComment($comment);
    }

    private function cautionComment()
    {
        if (array_key_exists('commentId', $_POST)) {
            $commentDAO = new CommentDAO();
            // Value 1 means the comment is now warned => flag = TRUE
            $commentDAO->flagComment($_POST['commentId'], '1');
        } else {
            $commentDAO = new CommentDAO();
        }
        return $commentDAO;
    }

    private function getCommentForm()
    {
        $this->sendPage();
    }

    private function postCommentForm()
    {
        if (array_key_exists('id',$_GET)) {
            $this->addComment();
        }
        if (array_key_exists('chapter',$_POST)) {
            $this->updateComment();
        }
    }

    private function updateComment()
    {
        $commentDAO = new CommentDAO();
        $comment = new Comment([
            'chapter'   => $_POST['chapter'],
            'author'    => $_POST['pseudo'],
            'content'   => $_POST['commentContent'],
            'id'        => $_POST['id']
        ]);
        $commentDAO->updateComment($comment);
    }
}