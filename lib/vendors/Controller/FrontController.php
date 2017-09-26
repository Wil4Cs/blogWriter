<?php

namespace Controller;

use DAO\ChapterDAO;
use DAO\CommentDAO;
use Model\Comment;

/**
 * Class PagesController
 */
class FrontController extends MainController
{
    private function addComment()
    {
        $commentDAO = new CommentDAO();
        $comment = new Comment([
            'chapterNumber'   => $_GET['id'],
            'author'    => $_POST['pseudo'],
            'content'   => $_POST['commentContent']
        ]);
        $commentDAO->addComment($comment);
    }

    private function cautionComment()
    {
        // Check if the key commentId exists in $_POST
        if (array_key_exists('commentId', $_POST)) {
            $commentDAO = new CommentDAO();
            // Value 1 means the comment is now warned => flag = TRUE
            $commentDAO->flagComment($_POST['commentId'], '1');
        } else {
            $commentDAO = new CommentDAO();
        }
        return $commentDAO;
    }

    public function comment()
    {
        // Guess if the form comment comes from Front(add a comment) or Back(edit a comment)
        if(empty($_GET['id'])) {
            $id = $_POST['chapter']; // 'chapter' in table comment = chapter's id
        } else {
            $id = $_GET['id'];
        }
        // Check if the chapter exists OR we return the error page
        if ($this->chapterExists('id', $id) == true) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Request method is POST so we need to insert a comment
                $this->postCommentForm();
                // Redirect browser to the correct show page
                header('Location: ?controller=front&action=show&id=' .$id);
            }
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Request method is GET so we need to post up the form
                $this->getCommentForm();
                $this->sendPage();
            }
        } else {
            $this->error();
        }
    }

    public function error()
    {
        require_once('../views/front/error.php');
        exit();
    }

    private function getCommentForm()
    {
        $user = $this->getApp()->getUser();
        if ($user->isAuthenticated())
        {
            // Get the chapter author's name to fill value of field pseudo
            $chapterDAO = new ChapterDAO();
            $adminName = $chapterDAO->findAdmin($_GET['id']);
            $this->page->setViewsVars('adminName', $adminName);
        }
    }

    public function index()
    {
        $this->wrapChaptersContent('450');
        // Include carousel for the main page only
        $view = '../views/front/carousel.php';
        $carousel = $this->page->getAdditionalContent($view);
        $this->page->setViewsVars('carousel', $carousel);
        $this->sendPage();
    }

    private function postCommentForm()
    {

        if (array_key_exists('id',$_GET)) {
            $this->addComment();
        }
        if (array_key_exists('chapter',$_POST)) { // 'chapter' in table comment = chapter's id
            $this->updateComment();
        }
    }

    public function show()
    {
        // Check if the chapter exists.
        if ($this->chapterExists('id', $_GET['id']) == true) {
            // Find the chapter to show
            $chapterDAO = new ChapterDAO();
            $chapter = $chapterDAO->find($_GET['id']);

            // Check if a comment has just been mention. The called method return a Comment object
            $commentDAO = $this->cautionComment();

            // Get all chapter's comments
            $comments = $commentDAO->getListOfComments($_GET['id']);

            // Construct page to return
            $this->page->setViewsVars('chapter', $chapter);
            $this->page->setViewsVars('comments', $comments);
            $this->sendPage();
        } else {
            $this->error();
        }
    }

    private function updateComment()
    {
        $commentDAO = new CommentDAO();
        $comment = new Comment([
            'chapterNumber'   => $_POST['chapter'],
            'author'    => $_POST['pseudo'],
            'content'   => $_POST['commentContent'],
            'id'        => $_POST['id']
        ]);
        $commentDAO->updateComment($comment);
    }
}