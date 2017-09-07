<?php

namespace Controller;

/**
 * Class PagesController
 */

class ChaptersController
{
    public function home()
    {
        $first_name = 'Jon';
        $last_name  = 'Snow';
        require_once('../views/Chapters/index.php');
    }

    public function error()
    {
        require_once('../views/Chapters/error.php');
    }
}
