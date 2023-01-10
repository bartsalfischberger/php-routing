<?php

// Autoload classes.
spl_autoload_register(fn($x) => include_once strtolower(str_replace("\\", DIRECTORY_SEPARATOR, $x)).".php");

include 'app/kernel.php';
?>
