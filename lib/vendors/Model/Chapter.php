<?php

namespace Model;


/**
 * Class Chapter
 *
 * @package Model
 */
class Chapter
{
    private $_author;
    private $_content;
    private $_date;
    private $_id;
    private $_chapterNumber;
    private $_imageName;
    private $_title;

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
                $camelCase = ucwords(str_replace('_', ' ', $key));

                $method = 'set' .str_replace(' ', '', $camelCase);

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
    public function getChapterNumber()
    {
        return $this->_chapterNumber;
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
    public function getImageName()
    {
        return $this->_imageName;
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
    public function setChapterNumber($number)
    {
        if (empty($number) || !ctype_digit($number))
        {
            return null;
        }
        $this->_chapterNumber = $number;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->_imageName = $imageName;
    }

    /**
     * @param $date
     */
    public function setPostDate($date)
    {
        $this->_date = new \DateTime($date);
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
