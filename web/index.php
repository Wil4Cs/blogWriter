<?php

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'chapters';
    $action     = 'home';
}
// Include the class allowing us to record our autoload
require __DIR__. '/../lib/Framework/SplClassLoader.php';

// Record all classes
$frameworkLoader = new SplClassLoader('Framework', __DIR__. '/../lib');
$frameworkLoader->register();

//$controllerLoader = new SplClassLoader('Controllers', __DIR__. '/../lib/vendors');
//$controllerLoader->register();

//$entityLoader = new SplClassLoader('Entity', __DIR__. '/../lib/vendors');
//$entityLoader->register();

require_once('../views/Templates/layout.php');
