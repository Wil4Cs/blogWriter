<?php

namespace Model;

use Framework\PDOFactory;

/**
 * Class DAO
 *
 * @package Model
 */
class DAO
{
    /**
     * @var \PDO
     */
    protected $_db;


    /**
     * DAO constructor.
     */
    public function __construct()
    {
        $this->_db = PDOFactory::getMySQL();
    }
}