<?php

namespace Framework;

/**
 * Class ApplicationComponent
 *
 * @package Framework
 */
class ApplicationComponent
{
    private $_app;

    /**
     * ApplicationComponent constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->_app = $app;
    }

    // GETTERS //
    public function getApp()
    {
        return $this->_app;
    }
}