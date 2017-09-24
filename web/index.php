<?php
session_start();

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'front';
    $action     = 'index';
}

// Include the class allowing us to record our autoload
require __DIR__. '/../lib/Framework/SplClassLoader.php';

// Record all classes
$applicationLoader = new SplClassLoader('App', __DIR__ . '/..');
$applicationLoader->register();

$frameworkLoader = new SplClassLoader('Framework', __DIR__. '/../lib');
$frameworkLoader->register();

$controllerLoader = new SplClassLoader('Controller', __DIR__. '/../lib/vendors');
$controllerLoader->register();

$entityLoader = new SplClassLoader('Model', __DIR__. '/../lib/vendors');
$entityLoader->register();

$modelLoader = new SplClassLoader('DAO', __DIR__. '/../lib/vendors');
$modelLoader->register();

$application = new \App\Application();
$application->Controller($controller, $action);
