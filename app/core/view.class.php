<?php

namespace core;

/**
 * Loads in the correct page to request. 
 */
class View
{
    /**
     * Connect view route to request.
     *
     * @param string $route
     * @return void
     */
    public static function display(string $route) 
    {
        include_once "app/view/$route.view.php";
    }
}
