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
        // Check if the chapter exists OR we return the error page
        if ($chapterDAO = $this->chapterExists('id', $_GET['id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Request method is POST so we need to insert a comment
                $this->postCommentForm();
                // Redirect browser to the correct show page
                header('Location: ?controller=' . $_GET['controller'] . '&action=show&id=' . $_GET['id']);
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
            $commentDAO = $this->flagComment();

            // Get all chapter's comments
            $comments = $commentDAO->getListOfComments($_GET['id']);


            // Construct page to return
            $this->page->setViewsVars('chapter', $chapter);
            $this->page->setViewsVars('comments', $comments);
            $this->sendPage();
        }
    }

    private function getCommentForm()
    {
        $this->sendPage();
    }

    private function postCommentForm()
    {
        $comment = new Comment([
            'chapter'   => $_GET['id'],
            'author'    => $_POST['pseudo'],
            'content'   => $_POST['commentContent']
        ]);
        $commentDAO = new CommentDAO();
        $commentDAO->addComment($comment);
    }

    private function flagComment()
    {
        if (array_key_exists('commentId', $_POST)) {
            $commentDAO = new CommentDAO();
            $commentDAO->cautionComment($_POST['commentId']);
        } else {
            $commentDAO = new CommentDAO();
        }
        return $commentDAO;
    }
}