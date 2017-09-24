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
    private $_redirectVars = [];

    public function getWholePage()
    {
        $user = $this->getApp()->getUser();

        // Include carousel for the main page only
        if ($GLOBALS['controller'] == 'front' && $GLOBALS['action'] == 'index') {
            ob_start();
            require_once('../views/front/carousel.php');
            $carousel = ob_get_clean();
        }
        if (!empty($this->_viewsVars)) {
            extract($this->_viewsVars);
        }

        $content = $this->getViewContent();
        require_once('../views/templates/' .$GLOBALS['controller']. 'Layout.php');
    }

    public function setRedirectVars($controller, $action)
    {
        if (!is_string($controller) && !is_string($action) || empty($controller) && empty($action))
        {
            throw new \RuntimeException('Specified variables must be set and be a string');
        }
        $this->_redirectVars['controller'] = $controller;
        $this->_redirectVars['action'] = $action;
    }

    public function setViewsVars($var, $value)
    {
        if (!is_string($var) || empty($var))
        {
            throw new \RuntimeException('The variable must be set and be a string');
        }
        $this->_viewsVars[$var] = $value;
    }

    private function getViewContent()
    {
        $user = $this->getApp()->getUser();
        if (!empty($this->_viewsVars)) {
            extract($this->_viewsVars);
        }
        ob_start();
        if (!empty($this->_redirectVars)) {
            // Load view manually
            require_once('../views/' . $this->_redirectVars['controller'] . '/' . $this->_redirectVars['action'] . '.php');
        } else {
            // Load view automatically
            require_once('../views/' . $GLOBALS['controller'] . '/' . $GLOBALS['action'] . '.php');
        }
        return ob_get_clean();
    }
}