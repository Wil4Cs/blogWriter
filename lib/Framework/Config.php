<?php

namespace Framework;

/**
 * Class Config
 *
 * @package Framework
 */
class Config
{
    /**
     * @var array
     */
    private $_credentials = [];

    /**
     * @param $var
     * @return mixed|null
     */
    public function get($var)
    {
        // Load admin.json file in $_credentials if it not already loaded. It contains login and password
        if (empty($this->_credentials))
        {
            $config = json_decode(file_get_contents('../App/config/admin.json'));
            foreach ($config as $key => $value)
            {
                $this->_credentials[$key] = $value;
            }
        }

        // First, check if $var is set in $_credentials and then return its value
        if (isset($this->_credentials[$var]))
        {
            return $this->_credentials[$var];
        }

        return null;
    }
}