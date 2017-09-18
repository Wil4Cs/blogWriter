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
        // Go to admin page if he is already authenticated
        if ($this->_admin->isAuthenticated())
        {
            require_once('../views/Admin/index.php');
        }

        // Go to connexion page if the form is not send and admin is not authenticated
        if (!isset($_POST['login']) && !$this->_admin->isAuthenticated())
        {
            require_once('../views/Admin/connexion.php');
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
                require_once('../views/Admin/index.php');

            } else {
                $this->_admin->setAlert('Le login ou le mot de passe est incorrect');
                require_once('../views/Admin/connexion.php');
            }
        }
    }
}