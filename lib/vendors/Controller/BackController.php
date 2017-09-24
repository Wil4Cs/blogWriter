<?php

namespace Controller;

use DAO\ChapterDAO;
use DAO\CommentDAO;
use Framework\Config;

/**
 * Class BackController
 *
 * @package Controller
 */
class BackController extends MainController
{
    public function comment()
    {
        // TODO: Implement comment() method.
    }

    public function moderateComment()
    {
        $this->allCautionComments();
        $this->sendPage();
    }

    public function disconnect()
    {
        session_destroy();
        header('Location: .');
    }

    public function eraseComment()
    {
        $id = $_GET['id'];
        $commentDAO= $this->commentExists($id);
        $commentDAO->eraseComment($id);
        header('Location: ?controller=' .$_GET['controller']. '&action=moderateComment');
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

    public function show()
    {
        // TODO: Implement show() method.
    }

    public function refreshComment()
    {
        $id = $_GET['id'];
        $commentDAO = $this->commentExists($id);
        $commentDAO->refreshComment($id);
        header('Location: ?controller=' .$_GET['controller']. '&action=moderateComment');
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

    private function commentExists($id)
    {
        $commentDAO = new CommentDAO($id);
        if (ctype_digit($id) && $commentDAO->ifCommentExists($id))
        {
            return $commentDAO;
        } else {
            return $this->error();
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
            header('Location: ?controller=' . $_GET['controller'] . '&action=' . $_GET['action']);

        } else {
            $user->setAlert('Le login ou le mot de passe est incorrect');
            $this->page->setRedirectVars('back','connection');
            $this->sendPage();
        }
    }
}