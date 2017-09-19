<?php

namespace Framework;


/**
 * Class PDOFactory
 *
 * @package Framework
 */
class PDOFactory
{

    /**
     * @return \PDO
     */
    public static function getMySQL()
    {
        try {
            $config = parse_ini_file('../app/config/dbSettings.ini');
            $db = new \PDO('mysql:host='.$config['db_host']. ';dbname='.$config['db_name'], $config['db_user'], $config['db_password']);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Connexion failed : ' . $e->getMessage();
        }

        return $db;
    }
}
