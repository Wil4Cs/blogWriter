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
     * @param array $data
     */
    public function __construct(array $data)
    {
        if(!empty($data)) {

            foreach ($data as $key => $value)
            {
                $method = 'set'.ucfirst($key);

                if (is_callable([$this, $method]))
                {
                    $this->$method($value);
                }
            }
        }
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
     * @param $content
     * @return null
     */
    public function setContent($content)
    {
        if (empty($content) || !is_string($content))
        {
            return null;
        }
        $this->_content = $content;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param $number
     * @return null
     */
    public function setNumber($number)
    {
        if (empty($number) || !ctype_digit($number))
        {
            return null;
        }
        $this->_number = $number;
    }

    /**
     * @param $date
     */
    public function setPostDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @param $title
     * @return null
     */
    public function setTitle($title)
    {
        if (empty($title) || !is_string($title))
        {
            return null;
        }
        $this->_title = $title;
    }
}
