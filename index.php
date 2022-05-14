<?php

/**
 * PHP routing project.
 * @copyright 2019 Bart Salfischberger
 */

// Obtain route request.
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Obtain request method.
$method = $_SERVER['REQUEST_METHOD'];

require_once 'app/loader.php';