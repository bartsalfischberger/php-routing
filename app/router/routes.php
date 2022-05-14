<?php

use core\Router as Router;
use core\View as View;

Router::get('/', function() {
    new controller\HomeController;
    View::display('home');
});