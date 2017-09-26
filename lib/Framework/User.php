<?php

namespace Framework;

/**
 * Class back
 *
 * @package Framework
 */
class User
{
    /**
     * @return mixed
     */
    public function getAlert()
    {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);

        return $alert;
    }

    /**
     * @return bool
     */
    public function hasAlert()
    {
        return isset($_SESSION['alert']) && is_string($_SESSION['alert']);
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    /**
     * @param $string
     */
    public function setAlert($string)
    {
            $_SESSION['alert'] = $string;
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
}