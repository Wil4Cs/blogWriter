<?php

namespace Framework;

class PDOFactory
{
    CONST DSN = 'mysql:host=localhost;dbname=blogWriter';
    CONST USERNAME = 'root';
    CONST PASSWORD = 'root';


    public static function getDb()
    {
        try {
            $db = new \PDO(SELF::DSN, SELF::USERNAME, SELF::PASSWORD);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Connexion failed : ' . $e->getMessage();
        }

        return $db;
    }
}
