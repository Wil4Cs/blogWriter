<?php

namespace Controller;


use Framework\Config;
use Framework\Admin;

/**
 * Class BackController
 *
 * @package Controller
 */
class BackController
{
    /**
     * @var Admin
     */
    private $_admin;

    /**
     * BackController constructor.
     */
    public function __construct()
    {
        $this->_admin = new Admin();
    }

    public function index()
    {
        // Go to Backend page if he is already authenticated
        if ($this->_admin->isAuthenticated())
        {
            ob_start();
            require_once('../views/Backend/index.php');
            $content = ob_get_clean();
            require_once ('../views/Templates/backLayout.php');
        }

        // Go to connexion page if the form is not send and Backend is not authenticated
        if (!isset($_POST['login']) && !$this->_admin->isAuthenticated())
        {
            ob_start();
            require_once('../views/Backend/connection.php');
            $content = ob_get_clean();
            require_once ('../views/Templates/backLayout.php');
        }

        // If the form is send
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $config = new Config();

            // And if login and password are correct
            if ($login == $config->get('login') && $password == $config->get('password'))
            {
                $this->_admin->setAuthenticated(true);
                ob_start();
                require_once('../views/Backend/index.php');
                $content = ob_get_clean();
                require_once ('../views/Templates/backLayout.php');

            } else {
                $this->_admin->setAlert('Le login ou le mot de passe est incorrect');
                ob_start();
                require_once('../views/Backend/connection.php');
                $content = ob_get_clean();
                require_once ('../views/Templates/backLayout.php');
            }
        }
    }

    public function disconnect()
    {
        session_destroy();
        header('Location: ?controller=front&action=index');
    }

}