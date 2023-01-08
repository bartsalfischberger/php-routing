<?php

namespace App\Core;

class View 
{
    /**
     * Pass variables to view and print the results.
     *
     * @param string $view file containing the view.
     * @param array $variables variables to be passed.
     * @return void
     */
    public static function make(string $view, array $variables = array()): void
    {
        // Extract variables to local.
        if(count($variables) > 0) extract($variables);

        // Create output buffer.
        ob_start();
        include __DIR__."/../view/".$view.".view.php";
        echo ob_get_clean();

        return;
    }
}