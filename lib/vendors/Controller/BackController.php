<?php

namespace Controller;

use DAO\ChapterDAO;
use DAO\CommentDAO;
use Framework\Config;
use Model\Chapter;

/**
 * Class BackController
 *
 * @package Controller
 */
class BackController extends MainController
{
    public function addChapter()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->sendPage();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Check if the chapter's number is already use. Send an alert if yes.
            if ($this->chapterExists('chapter_number', $_POST['chapterNumber'])) {
                $user = $this->getApp()->getUser();
                $user->setAlert('This chapter\'s number is already use. Please enter a new one !');
                header('Location: ?controller=back&action=addChapter');
            } else {
                $chapterDAO = new ChapterDAO();
                $chapter = new Chapter([
                    'author'        => $_POST['chapterAuthor'],
                    'content'       => $_POST['chapterContent'],
                    'chapterNumber' => $_POST['chapterNumber'],
                    'title'         => $_POST['chapterTitle']
                ]);
                // Add the chapter and return the last insert id in db.
                $lastId = $chapterDAO->addChapter($chapter);
                header('Location: ?controller=front&action=show&id=' .$lastId);
            }
        }
    }

    public function deleteChapter()
    {
        if ($this->chapterExists('id', $_GET['id']) == true)
        {
            // Delete the chapter
            $chapterDAO = new ChapterDAO();
            $chapterDAO->deleteChapter($_GET['id']);
            // Delete all comments of this chapter
            $commentDAO = new CommentDAO();
            $commentDAO->eraseAllComments($_GET['id']);
            header('Location: ?controller=back&action=show');
        } else {
            $this->error();
        }
    }

    public function disconnect()
    {
        session_destroy();
        header('Location: .');
    }

    public function editChapter()
    {
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                if ($this->chapterExists('id', $_GET['id']))
                {
                    $chapterDAO = new ChapterDAO();
                    $chapter = $chapterDAO->find($_GET['id']);
                    $this->page->setViewsVars('chapter', $chapter);
                    $this->sendPage();
                } else {
                    $this->error();
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Find the chapter's number from the post id
                $chapterDAO = new ChapterDAO();
                $chapterNumber = $chapterDAO->findChapterNumber($_POST['id']);

                // Check if the chapter's number has been modified or UPDATE the chapter
                if ( $chapterNumber != $_POST['chapterNumber'])
                {
                    // Chapter's number has been modified so check if this number is not already use or UPDATE the chapter
                    if ($this->chapterExists('chapter_number', $_POST['chapterNumber']))
                    {
                        $user = $this->getApp()->getUser();
                        $user->setAlert('This chapter\'s number is already use. Please enter a new one !');
                        header('Location: ?controller=back&action=editChapter&id=' . $_POST['id']);
                    } else {
                        $this->updateChapter($chapterDAO);
                    }

                } else {
                    $this->updateChapter($chapterDAO);
                }
            }
    }

    public function editComment()
    {
        $commentDAO = $this->commentExists($_GET['id']);
        $comment = $commentDAO->getComment($_GET['id']);
        // Construct page to return
        $this->page->setViewsVars('comment', $comment);
        $this->sendPage();
    }

    public function eraseComment()
    {
        $id = $_GET['id'];
        $commentDAO= $this->commentExists($id);
        // Check if we erase the comment from front or admin section to return the correct header
        if (!empty($_SERVER['HTTP_REFERER']) && preg_match("#front#", $_SERVER['HTTP_REFERER'])) {
            $commentDAO->eraseComment($id);
            header('Location: ' .$_SERVER['HTTP_REFERER']);
        } else {
            $commentDAO->eraseComment($id);
            header('Location: ?controller=back&action=moderateComment');
        }
    }

    public function error()
    {
        require_once('../views/front/error.php');
        exit();
    }

    public function index()
    {
        $user = $this->getApp()->getUser();
        // Go to admin page if he is already authenticated
        if ($user->isAuthenticated())
        {
            $this->numbersOfChapters();
            $this->numbersOfCautionComments();
            $this->sendPage();
        }
        // Go to connexion page if the form is not send and user is not authenticated
        if (!isset($_POST['login']) && !$user->isAuthenticated())
        {
            // Construct page to return manually
            $this->page->setRedirectViewVars('back', 'connection');
            $this->sendPage();
        }
        // If the form is send
        if (isset($_POST['login'])) {
            $this->validConnectionForm();
        }
    }

    public function moderateComment()
    {
        $commentDAO = new CommentDAO();
        $allCautionComments = $commentDAO->getAllCautionComments();
        $this->page->setViewsVars('allCautionComments', $allCautionComments);
        $this->sendPage();
    }

    public function refreshComment()
    {
        $id = $_GET['id'];
        $commentDAO = $this->commentExists($id);
        // Value 0 means the comment is not warned => flag = FALSE
        $commentDAO->flagComment($id, '0');
        header('Location: ?controller=back&action=moderateComment');
    }

    public function show()
    {
        $this->wrapChaptersContent('300');
        $this->sendPage();
    }

    private function checkPostCredentials()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $config = new Config();
        // Check if the login and the password are correct
        if ($login == $config->get('login') && $password == $config->get('password'))
        {
            return true;
        }
    }

    private function numbersOfCautionComments()
    {
        $commentDAO = new CommentDAO();
        $numbersOfCautionComments= $commentDAO->countFlag();
        $this->page->setViewsVars('numbersOfCautionComments', $numbersOfCautionComments);
    }

    private function numbersOfChapters()
    {
        $chapterDAO = new ChapterDAO();
        $numbersOfChapters= $chapterDAO->count();
        $this->page->setViewsVars('numbersOfChapters', $numbersOfChapters);
    }

    private function updateChapter(ChapterDAO $chapterDAO)
    {
        $chapter = new Chapter([
            'author'        => $_POST['chapterAuthor'],
            'content'       => $_POST['chapterContent'],
            'chapterNumber' => $_POST['chapterNumber'],
            'id'            => $_POST['id'],
            'title'         => $_POST['chapterTitle']
        ]);
        $chapterDAO->updateChapter($chapter);
        header('Location: ?controller=front&action=show&id=' .$_POST['id']);
    }

    private function validConnectionForm()
    {
        $credentials = $this->checkPostCredentials();
        $user = $this->getApp()->getUser();

        // If login and password are correct
        if ($credentials === true)
        {
            $user->setAuthenticated(true);
            header('Location: ?controller=back&action=index');

        } else {
            // Send an alert and construct page to return manually
            $user->setAlert('Your login or password is not correct!');
            $this->page->setRedirectViewVars('back','connection');
            $this->sendPage();
        }
    }
}