<?php

use App\Core\Router as Router;

Router::$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Include routes.
include 'app/routes/routes.php';

Router::destruct();