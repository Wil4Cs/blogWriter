<?php

namespace Entity;


/**
 * Class Chapter
 *
 * @package Entity
 */

class Chapter
{
    private $id;
    private $author;
    private $title;
    private $content;
    private $date;

    // GETTERS //
    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function __construct($id, $author, $title, $content, $date)
    {
        $this->id      = $id;
        $this->author  = $author;
        $this->title   = $title;
        $this->content = $content;
        $this->date    = $date;
    }
}
