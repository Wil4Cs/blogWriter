<?php

namespace Controller;


use Model\ChapterDAO;

/**
 * Class PagesController
 */

class FrontController
{
    const maxLengthContent = '450';

    public function index()
    {
        $chapters= ChapterDAO::findAllChapters();
        // Wrap content if it is higher than maxLengthContent
        foreach ($chapters as $chapter)
        {
            if (strlen($chapter->getContent()) > SELF::maxLengthContent) {
                $wrapContent = substr($chapter->getContent(), 0, SELF::maxLengthContent);
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

        // Return chapters in increasing order for the menu "Chapitres" in the nav-bar
        $chapters = array_reverse($chapters, true);
        require_once ('../views/Templates/layout.php');
    }

    public function error()
    {
        require_once('../views/Chapters/error.php');
    }

    public function show()
    {
        $id = $_GET['id'];
        $chapter = ChapterDAO::find($id);
        // check whether the identifier is set, is a number and it exists
        if (isset($id) && is_numeric($id) && $chapter != false) {
            ob_start();
            require_once('../views/Chapters/show.php');
            $content = ob_get_clean();

            $chapters = ChapterDAO::findAllChapters();
            // Return chapters in increasing order for the menu "Chapitres" in the nav-bar
            $chapters = array_reverse($chapters, true);
            require_once('../views/Templates/layout.php');
        } else {
            return $this->error();
        }
    }
}
