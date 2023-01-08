<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload classes.
spl_autoload_register(fn($x) => include_once strtolower(str_replace("\\", DIRECTORY_SEPARATOR, $x)).".php");

include 'app/kernel.php';
?>