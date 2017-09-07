<?php

function call($controller, $action) {
    require_once('../lib/vendors/Controller/' . $controller . '_controller.php');

    switch($controller) {
        case 'chapters':
            $controller = new \Controller\ChaptersController();
            break;
        case 'posts':
            // we need the model to query the database later in the controller
            require_once('../lib/vendors/Entity/Chapter.php');
            $controller = new \Controller\PostsController();
            break;
    }

    $controller->{ $action }();
}

// we're adding an entry for the new controller and its actions
$controllers = array('chapters' => ['home', 'error'],
                       'posts' => ['index', 'show']);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Chapters', 'error');
    }
} else {
    call('Chapters', 'error');
}
