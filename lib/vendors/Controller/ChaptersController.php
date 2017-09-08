<?php

namespace Controller;


use Model\ChapterDAO;

/**
 * Class PagesController
 */

class ChaptersController
{
    public function index()
    {
        $chapters= ChapterDAO::findAllChapters();
        $maxContentLength = '450';
        foreach ($chapters as $chapter)
        {
            if (strlen($chapter->getContent()) > $maxContentLength)
            {
                $wrapContent = substr($chapter->getContent(), 0, $maxContentLength);
                $wrapContent = substr($wrapContent, 0, strrpos($wrapContent, ' ')) . '...';
                $chapter->setContent($wrapContent);
            }
        }
        ob_start();
            require_once ('../views/Templates/carousel.php');
        $carousel = ob_get_clean();

        ob_start();
            require_once('../views/Chapters/index.php');
        $content = ob_get_clean();

        $numberOfChapters = ChapterDAO::count();
        require_once ('../views/Templates/layout.php');
    }

    public function error()
    {
        require_once('../views/Chapters/error.php');
    }

    public function show()
    {
        // we expect a url of form ?controller=posts&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        $id = $_GET['id'];
        if (!isset($id))
            return call('Chapters', 'error');
        // we use the given id to get the right post
        $chapter = ChapterDAO::find($id);
        ob_start();
        require_once('../views/Chapters/show.php');
        $content = ob_get_clean();
        $numberOfChapters = ChapterDAO::count();
        require_once ('../views/Templates/layout.php');
    }
}
