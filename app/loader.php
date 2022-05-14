<?php

// Autload core classes.
spl_autoload_register( function ($class) {
    $classFile = 'app/'.str_replace('\\', '/', strtolower($class)).'.class.php';
    if (file_exists($classFile)) include_once $classFile;
});

// Init the router with data.
core\Router::init($uri, $method);

include_once 'app/router/routes.php';