<?php

namespace Framework;

session_start();

/**
 * Class Backend
 *
 * @package Framework
 */
class User
{
    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    /**
     * @param $bool
     */
    public function setAuthenticated($bool)
    {
        if (is_bool($bool))
        {
            $_SESSION['auth'] = $bool;
        }
    }

    /**
     * @return mixed
     */
    public function getAlert()
    {
        return $_SESSION['alert'];
        unset($_SESSION['alert']);
    }

    /**
     * @return bool
     */
    public function hasAlert()
    {
        return isset($_SESSION['alert']) && is_string($_SESSION['alert']);
    }

    /**
     * @param $string
     */
    public function setAlert($string)
    {
            $_SESSION['alert'] = $string;
    }

}