<?php

/**
 * Class PDOFactory
 */

class PDOFactory
{
    private static $db;

    CONST DSN = 'mysql:host=localhost;dbname=blogWriter';
    CONST USERNAME = 'root';
    CONST PASSWORD = 'root';


    public static function getDb()
    {
        if (!isset(self::$db))
        {
            try {
                self::$db = new PDO(SELF::DSN, SELF::USERNAME, SELF::PASSWORD);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connexion failed : ' . $e->getMessage();
            }
        }
        return self::$db;
    }
}
