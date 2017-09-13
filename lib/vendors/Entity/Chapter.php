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
    private $_number;
    private $_author;
    private $_title;
    private $_content;
    private $_date;

    /**
     * Chapter constructor.
     *
     * @param $id
     * @param $number
     * @param $author
     * @param $title
     * @param $content
     * @param $date
     */
    public function __construct($id, $number, $author, $title, $content, $date)
    {
        $this->_id       = $id;
        $this->_number  = $number;
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
    public function getNumber()
    {
        return $this->_number;
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
