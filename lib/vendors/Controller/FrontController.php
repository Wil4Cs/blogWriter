<?php

namespace Controller;


use DAO\ChapterDAO;
use DAO\CommentDAO;
use Model\Comment;
/**
 * Class PagesController
 */
class FrontController
{
    public function error()
    {
        require_once('../views/Chapters/error.php');
    }

    public function index()
    {
        $maxLengthContent = '450';
        $chapterDAO = new ChapterDAO();
        $chapters = $chapterDAO->findAllChapters();
        // Wrap content if it is higher than maxLengthContent
        foreach ($chapters as $chapter) {
            if (strlen($chapter->getContent()) > $maxLengthContent) {
                $wrapContent = substr($chapter->getContent(), 0, $maxLengthContent);
                $wrapContent = substr($wrapContent, 0, strrpos($wrapContent, ' ')) . '...';
                $chapter->setContent($wrapContent);
            }
        }
        ob_start();
        require_once('../views/Templates/carousel.php');
        $carousel = ob_get_clean();
        ob_start();
        require_once('../views/Chapters/index.php');
        $content = ob_get_clean();
        // Return chapters in increasing order for the menu "Chapitres" in the nav-bar
        $chapters = array_reverse($chapters, true);
        require_once('../views/Templates/frontLayout.php');
    }

    public function show()
    {
        $chapterDAO = new ChapterDAO();
        // Check whether the identifier is set, is an integer number and if the chapter id exists OR we return the error page
        if (isset($_GET['id']) && ctype_digit($_GET['id']) && $chapterDAO->ifExists(array('id', $_GET['id']))) {
            // Find the chapter to show
            $chapter = $chapterDAO->find($_GET['id']);
            // Check if a comment has just been mention
            $commentDAO = new CommentDAO();
            if (array_key_exists('commentId', $_POST)) {
                $commentDAO->cautionComment($_POST['commentId']);
            }
            //Get all chapter's comments
            $comments = $commentDAO->getListOfComments($_GET['id']);
            ob_start();
            require_once('../views/Chapters/show.php');
            $content = ob_get_clean();
            //Get all chapter's for the menu "Chapitres" in the nav-bar
            $chapters = $chapterDAO->findAllChapters();
            // Return chapters in increasing order
            $chapters = array_reverse($chapters, true);
            require_once('../views/Templates/frontLayout.php');
        } else {
            return $this->error();
        }
    }

    public function insertComment()
    {
        $chapterDAO = new ChapterDAO();
        // Check whether the identifier is set, is an integer number and if the chapter id exists OR we return the error page
        if (isset($_GET['id']) && ctype_digit($_GET['id']) && $chapterDAO->ifExists(array('id', $_GET['id']))) {
            // Request method is GET so we need to post up the form
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                ob_start();
                require_once('../views/Chapters/insertComment.php');
                $content = ob_get_clean();
                $chapters = $chapterDAO->findAllChapters();
                // Return chapters in increasing order for the menu "Chapitres" in the nav-bar
                $chapters = array_reverse($chapters, true);
                require_once('../views/Templates/frontLayout.php');
            } else {
                // Request method is POST so we need to insert a comment
                $comment = new Comment([
                    'chapter'   => $_GET['id'],
                    'author'    => $_POST['pseudo'],
                    'content'   => $_POST['commentContent']
                ]);
                $commentDAO = new CommentDAO();
                $commentDAO->addComment($comment);
                // Redirect browser to the correct show page
                header('Location: ?controller='.$_GET['controller'].'&action=show&id='.$_GET['id']);
            }
        } else {
            return $this->error();
        }
    }
}