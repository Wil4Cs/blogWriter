<?php

namespace DAO;

use Framework\PDOFactory;

/**
 * Class DAO
 *
 * @package DAO
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