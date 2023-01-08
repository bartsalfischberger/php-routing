<?php

namespace App\Controller;

use App\Core\Controller;

class HomeController extends Controller
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