<?php

namespace Controller;

use App\Application;
use Framework\ApplicationComponent;
use Framework\Page;
use DAO\ChapterDAO;
use DAO\CommentDAO;

/**
 * Class MainController
 *
 * @package Controller
 */
abstract class MainController extends ApplicationComponent
{
    protected $page;

    /**
     * MainController constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
        $this->page = new Page($application);
    }

    abstract public function error();

    abstract public function index();

    abstract public function show();

    protected function chapterExists($nameColumn, $number)
    {
        $chapterDAO = new ChapterDAO();
        // Check whether the $number is set, is an integer and if the $number exists in db nameColumn
        if (isset($number) && ctype_digit($number) && $chapterDAO->ifChapterExists(array($nameColumn, $number)))
        {
            return true;
        } else {
            return false;
        }
    }

    protected function commentExists($id)
    {
        $commentDAO = new CommentDAO($id);
        if (ctype_digit($id) && $commentDAO->ifCommentExists($id))
        {
            return $commentDAO;
        } else {
            return $this->error();
        }
    }

    protected function getIncreaseChaptersList()
    {
        // Get all  chapters in increasing order for the menu "Chapters" in the nav-bar
        $chapterDAO = new ChapterDAO();
        $chaptersList = $chapterDAO->findAllChapters();
        $chaptersList = array_reverse($chaptersList, true);
        $this->page->setViewsVars('chaptersList', $chaptersList);
    }

    protected function sendPage()
    {
        $this->getIncreaseChaptersList();
        $this->page->getWholePage();
        exit();
    }

    protected function wrapChaptersContent($maxLengthContent)
    {
        if (!ctype_digit($maxLengthContent))
        {
            throw new \RuntimeException('Specified numbers of characters must be an integer');
        }
        $chapterDAO = new ChapterDAO();
        $chapters = $chapterDAO->findAllChapters();
        // Wrap content if it is higher than maxLengthContent
        foreach ($chapters as $chapter) {
            if (strlen($chapter->getContent()) > $maxLengthContent) {
                $wrapContent = substr($chapter->getContent(), 0, $maxLengthContent);
                $wrapContent = substr($wrapContent, 0, strrpos($wrapContent, ' ')) . '...';
                $chapter->setContent($wrapContent);
            }
        }
        $this->page->setViewsVars('chapters', $chapters);
    }
}