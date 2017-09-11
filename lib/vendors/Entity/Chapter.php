<?php

namespace Entity;


/**
 * Class Chapter
 *
 * @package Entity
 */

class Chapter
{
    private $_id;
    private $_chapter;
    private $_author;
    private $_title;
    private $_content;
    private $_date;

    /**
     * Chapter constructor.
     *
     * @param $id
     * @param $chapter
     * @param $author
     * @param $title
     * @param $content
     * @param $date
     */
    public function __construct($id, $chapter, $author, $title, $content, $date)
    {
        $this->_id       = $id;
        $this->_chapter  = $chapter;
        $this->_author   = $author;
        $this->_title    = $title;
        $this->_content  = $content;
        $this->_date     = $date;
    }

    // GETTERS //
    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * @return mixed
     */
    public function getChapter()
    {
        return $this->_chapter;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    // SETTERS //
    /**
     * @param mixed $_content
     */
    public function setContent($_content)
    {
        $this->_content = $_content;
    }
}
