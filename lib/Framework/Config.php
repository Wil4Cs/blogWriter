<?php
/**
 * Created by PhpStorm.
 * User: wilfriedcottineau
 * Date: 16/09/2017
 * Time: 13:19
 */

namespace Framework;


class Config
{
    private static $_credentials = [];

    public static function get($var)
    {
        if (empty(self::$_credentials))
        {
            $config = json_decode(file_get_contents('../app/config/admin.json'), true);
            foreach ($config as $key => $value)
            {
                self::$_credentials[$key] = $value;
            }
        }
        if (isset(self::$_credentials[$var]))
        {
            return self::$_credentials[$var];
        }

        return null;
    }
}