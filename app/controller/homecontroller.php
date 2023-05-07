<?php

namespace App\Controller;

class HomeController
{
    public function test(): string
    {
        return "data";
    }

    public function show(): void
    {
        echo "Controller is showing some ".$this->test();
    }
}