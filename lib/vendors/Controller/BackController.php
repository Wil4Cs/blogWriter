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
            if ($this->chapterExists('chapterNumber', $_POST['chapterNumber']) == true) {
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
            $chapterDAO = new ChapterDAO();
            $chapterDAO->deleteChapter($_GET['id']);
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

    public function editComment()
    {
        $commentDAO = $this->commentExists($_GET['id']);
        $comment = $commentDAO->getComment($_GET['id']);
        $this->page->setViewsVars('comment', $comment);
        $this->sendPage();
    }

    public function eraseComment()
    {
        $id = $_GET['id'];
        $commentDAO= $this->commentExists($id);
        // Check if we erase the comment from front or back section to return the correct header
        if (!empty($_SERVER['HTTP_REFERER']) && preg_match("#front#", $_SERVER['HTTP_REFERER'])) {
            //$chapterId = $commentDAO->findChapterOfComment($id);
            $commentDAO->eraseComment($id);
            //header('Location: ?controller=front&action=show&id=' .$chapterId);
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
        // Go to back page if he is already authenticated
        if ($user->isAuthenticated())
        {
            $this->numbersOfChapters();
            $this->numbersOfCautionComments();
            $this->sendPage();
        }
        // Go to connexion page if the form is not send and user is not authenticated
        if (!isset($_POST['login']) && !$user->isAuthenticated())
        {
            $this->page->setRedirectVars('back', 'connection');
            $this->sendPage();
        }
        // If the form is send
        if (isset($_POST['login'])) {
            $this->validConnectionForm();
        }
    }

    public function moderateComment()
    {
        $this->allCautionComments();
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

    private function allCautionComments()
    {
        $commentDAO = new CommentDAO();
        $allCautionComments = $commentDAO->getAllCautionComments();
        $this->page->setViewsVars('allCautionComments', $allCautionComments);
    }

    private function checkPostCredentials()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $config = new Config();
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

    private function validConnectionForm()
    {
        $credentials = $this->checkPostCredentials();
        $user = $this->getApp()->getUser();

        // And if login and password are correct
        if ($credentials === true)
        {
            $user->setAuthenticated(true);
            header('Location: ?controller=back&action=index');

        } else {
            $user->setAlert('Your login or password is not correct!');
            $this->page->setRedirectVars('back','connection');
            $this->sendPage();
        }
    }
}