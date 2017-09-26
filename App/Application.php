<?php

namespace App;

use Controller\BackController;
use Controller\FrontController;
use Framework\User;

class Application
{
    private $_user;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->_user = new User($this);
    }

    function call($controller, $action) {
        switch($controller) {
            case 'front':
                $controller = new FrontController($this);
                break;
            case 'back':
                if (!$this->_user->isAuthenticated()) {
                    $action = 'index';
                }
                $controller = new BackController($this);
                break;
        }
        $controller->$action($this);
    }

    public function Controller($controller, $action)
    {
        $roads = $this->Rooting();
        if (array_key_exists($controller, $roads)) {
            if (in_array($action, $roads[$controller])) {
                $this->call($controller, $action);
            } else {
                $this->call('front', 'error');
            }
        } else {
            $this->call('front', 'error');
        }
    }

    public function Rooting()
    {
        // Load all roads
        $roads = array(
            'front' => ['index', 'show', 'error', 'comment'],
            'back'  => ['index', 'show', 'disconnect', 'addChapter', 'deleteChapter', 'editChapter', 'editComment', 'eraseComment', 'moderateComment', 'refreshComment']
        );
        return $roads;
    }

    // GETTERS //
    public function getUser()
    {
        return $this->_user;
    }
}