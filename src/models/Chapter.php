<?php

/**
 * Class Chapter
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

    public static function all()
    {
        $list = [];
        $db = PDOFactory::getDb();
        $req = $db->query('SELECT * FROM chapters');

        // we create a list of Post objects from the database results
        foreach($req->fetchAll() as $chapter)
        {
            $list[] = new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
        }

        return $list;
    }

    public static function find($id)
    {
        $db = PDOFactory::getDb();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM chapters WHERE id = :id');

        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $chapter = $req->fetch();

        return new Chapter($chapter['id'], $chapter['author'], $chapter['title'], $chapter['content'], $chapter['postDate']);
    }
}
