<?php

namespace Entity;


/**
 * Class Comment
 *
 * @package Entity
 */

class Comment
{
    private $_id;
    private $_author;
    private $_content;
    private $_date;
    private $_chapter;
    private $_flag;

    /**
     * Comment constructor.
     *
     * @param $_id
     * @param $_author
     * @param $_content
     * @param $_date
     * @param $_chapter
     * @param $_flag
     */
    public function __construct($_id, $_author, $_content, $_date, $_chapter, $_flag)
    {
        $this->_id = $_id;
        $this->_author = $_author;
        $this->_content = $_content;
        $this->_date = $_date;
        $this->_chapter = $_chapter;
        $this->_flag = $_flag;
    }

    public function isValid()
    {
        return !(empty($this->_author) || empty($this->content));
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
    public function getFlag()
    {
        return $this->_flag;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    // SETTERS //
    /**
     * @param $author
     * @return null
     */
    public function setAuthor($author)
    {
        if (empty($author) || !is_string($author))
        {
            return null;
        }
        $this->_author = $author;
    }

    /**
     * @param $chapter
     */
    public function setChapter($chapter)
    {
        $this->_chapter = (int)$chapter;
    }

    /**
     * @param $content
     * @return null
     */
    public function setContent($content)
    {
        if(empty($content)  || !is_string($content))
        {
            return null;
        }
        $this->_content = $content;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag($flag)
    {
        $this->_flag = $flag;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }
}