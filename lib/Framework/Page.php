<?php

namespace Framework;

/**
 * Class Page
 *
 * @package Framework
 */
class Page extends ApplicationComponent
{
    private $_viewsVars = [];
    private $_redirectViewVars = [];

    public function getWholePage()
    {
        $user = $this->getApp()->getUser();

        // Extract views vars to use it
        if (!empty($this->_viewsVars))
        {
            extract($this->_viewsVars);
        }

        ob_start();
        // Check if we need to redirect to another page
        if (!empty($this->_redirectViewVars)) {
            // Load view manually
            require_once('../views/' . $this->_redirectViewVars['controller'] . '/' . $this->_redirectViewVars['action'] . '.php');
        } else {
            // Load view automatically
            require_once('../views/' . $GLOBALS['controller'] . '/' . $GLOBALS['action'] . '.php');
        }
        $content = ob_get_clean();

        // Get the Layout
        require_once('../views/templates/' .$GLOBALS['controller']. 'Layout.php');
    }

    public function setRedirectViewVars($controller, $action)
    {
        if (!is_string($controller) && !is_string($action) || empty($controller) && empty($action))
        {
            throw new \RuntimeException('Specified variables must be set and be a string');
        }
        $this->_redirectViewVars['controller'] = $controller;
        $this->_redirectViewVars['action'] = $action;
    }

    public function setViewsVars($var, $value)
    {
        if (!is_string($var) || empty($var))
        {
            throw new \RuntimeException('The variable must be set and be a string');
        }
        $this->_viewsVars[$var] = $value;
    }

    public function getAdditionalContent($view)
    {
        ob_start();
        require_once($view);
        return ob_get_clean();
    }
}