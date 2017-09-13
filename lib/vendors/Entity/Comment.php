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

    public function isValid()
    {
        return !(empty($this->author) || empty($this->_author));
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
     * @param mixed $news
     */
    public function setChapter($news)
    {
        $this->_chapter = $news;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
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