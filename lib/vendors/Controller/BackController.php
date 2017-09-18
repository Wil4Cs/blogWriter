<?php
/**
 * Created by PhpStorm.
 * User: wilfriedcottineau
 * Date: 16/09/2017
 * Time: 13:26
 */

namespace Controller;

use Framework\Config;

class BackController
{
    public function connexion()
    {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if ($login == Config::get('login') && $password == Config::get('password')) {
                require_once('../views/Admin/index.php');
                exit();
            }
        }
        require_once('../views/Admin/connexion.php');
    }
}