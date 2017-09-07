<?php

namespace Controller;

use Model\ChapterDAO;

/**
 * Class PostsController
 */

class PostsController
{
    public function index()
    {
        // we store all the chapters in a variable
        $chapters = ChapterDAO::findAllChapters();
        require_once('../views/posts/index.php');
    }

    public function show()
    {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id']))
            return call('Chapters', 'error');
        // we use the given id to get the right post
        $chapter = ChapterDAO::find($_GET['id']);
        require_once('../views/posts/show.php');
    }
}
