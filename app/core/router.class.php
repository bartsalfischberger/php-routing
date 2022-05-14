<?php

namespace core;

use Closure;

/**
 * All router functionality.
 */
class Router 
{
    private static string $uri;
    private static string $method;

    public static function init(string $uri, string $method)
    {
        self::$uri = $uri;
        self::$method = $method;
    }

    /**
     * Get and post function checks if the route is correct
     * then runs the closure.
     *
     * @param string $route
     * @param Closure $function
     */
    public static function get(string $route, Closure $function) 
    {
        
        // Check if current route is correct.
        if (self::$uri == $route && self::$method == "GET") {
            $function->__invoke();
            exit();
        }
    }

    // Add more functionality here.
}