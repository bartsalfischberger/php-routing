<?php

namespace App\Core;

use App\Core\View;

use Closure;

/**
 * Router contains all routing related functions.
 */
class Router
{
    public static string $uri;

    public static array $routes = array();

    /**
     * Execture closure or class array. Guard must return TRUE for
     * the $fn callable to be invoked.
     *
     * @param Closure|array|boolean $guard
     * @param Closure $fn
     * @return void
     */
    public static function filter(mixed $guard, Closure $fn): void
    {
        if ($guard) $fn->__invoke();
    }

    /**
     * GET request function.
     *
     * @param string $slug
     * @param Closure|string|array $action
     * @return void
     */
    public static function get(string $slug, mixed $action = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") self::runRoute($slug, $action);
        return;
    }

    /**
     * POST request function.
     *
     * @param string $slug
     * @param closure|string|array $action
     * @return void
     */
    public static function post(string $slug, mixed $action = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") self::runRoute($slug, $action);
        return;
    }

    public static function abort(closure $fn): void
    {
        if (!in_array(self::$uri, self::$routes)) $fn->__invoke();
    }

    /**
     * Redirect to other resource.
     *
     * @param string $slug
     * @param string $redirect
     * @param integer $code HTTP code.
     * @return void
     */
    public static function redirect(string $slug, string $redirect, int $code = 302): void 
    {
        header("Location: ".$redirect, true, $code);
        return;
    }

    /**
     * Runs the route logic.
     *
     * @param string $slug
     * @param closure|string|array $action
     * @return void
     */
    public static function runRoute(string $slug, mixed $action)
    {
        // Check route validity.
        $validity = self::isValid($slug, self::$uri);
        if (!empty($validity)) {
            array_push(self::$routes, self::$uri);
            if (is_string($action) || is_callable($action)) {

                // Check for variables.
                if (str_contains($slug, '{')) {
                    if (is_callable($action)) $action->__invoke($validity);
                    if (is_string($action)) View::make($action, $validity);
                }

                if ($slug == self::$uri) {
                    if (is_callable($action)) $action->__invoke();
                    if (is_string($action)) View::make($action);
                }
            }

            if (is_array($action)) {
                $c = new $action[0]();
                (str_contains($slug, '{')) ? $c->{$action[1]}($validity) : $c->{$action[1]}();
            }            
        }

        return;
    }

    /**
     * Check validity.
     *
     * @param string $route
     * @param string $request
     * @return int|null|array 1 for valid route, NULL for invalid route and array for valid route with variables.
     */
    protected static function isValid(string $route, string $request): mixed
    {
        if (str_contains($route, '{')) {
            $variables = self::scanner($route, $request);
            return (!empty($variables)) ? $variables : null;
        }

        return ($route == $request) ? 1 : null;
    }

    /**
     * Scan routing slug for variables.
     *
     * @param string $slug
     * @param string $url
     * @return array
     */
    protected static function scanner(string $slug, string $url): array
    {
        $url_arr = explode('/', substr($url, 1));
        $slug_arr = explode('/', substr($slug, 1));

        $variables = array();

        // Lenght of both exploded array's should be the same.
        if (count($url_arr) == count($slug_arr)) {
            foreach ($slug_arr as $k => $v) {

                // Return empty array if $slug and $url have a mismatch.
                if (!str_starts_with($v, '{') && !str_ends_with($v, '}') && $v !== $url_arr[$k]) 
                    return array();

                // Push variable name and value to the variable array.
                if (str_starts_with($v, '{') && str_ends_with($v, '}')) {
                    if (empty($url_arr[$k])) return array();
                    $variables[trim($v, '{}')] = $url_arr[$k];
                }
            }
        }

        return $variables;
    }

    /**
     * End of routing.
     *
     * @return void
     */
    static function destruct() {

        // Promt 404 page.
        if (!in_array(self::$uri, self::$routes)) View::make("err/404");
    }
}