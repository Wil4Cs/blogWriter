<?php

function call($controller, $action) {
    require_once('../lib/vendors/Controller/' . $controller . 'Controller.php');

    switch($controller) {
        case 'chapters':
            $controller = new \Controller\ChaptersController();
            break;
    }

    $controller->{ $action }();
}

// Add an entry for the new controller and its actions
$controllers = array(
    'chapters' => ['index', 'show', 'error']
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Chapters', 'error');
    }
} else {
    call('Chapters', 'error');
}
