<?php

function call($controller, $action) {
    require_once ('../lib/vendors/Controller/' . ucfirst($controller) . 'Controller.php');

    switch($controller) {
        case 'front':
            $controller = new \Controller\FrontController();
            break;
        case 'back':
            $controller = new \Controller\BackController();
            break;
    }

    $controller->{ $action }();
    exit();
}

// Add an entry for the new controller and its actions
$controllers = array(
    'front' => ['index', 'show', 'error', 'insertComment'],
    'back'  => ['index']
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('front', 'error');
    }
} else {
    call('front', 'error');
}
