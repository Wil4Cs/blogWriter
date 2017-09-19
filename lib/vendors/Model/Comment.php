<?php

namespace Model;


/**
 * Class Comment
 *
 * @package Model
 */
class Comment
{
    private $_author;
    private $_chapter;
    private $_content;
    private $_date;
    private $_flag;
    private $_id;

    /**
     * Comment constructor.
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

    /**
     * @param $date
     */
    public function setPostDate($date)
    {
        $this->_date = new \DateTime($date);
    }
}