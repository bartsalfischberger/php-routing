<?php

use App\Core\Router;
use App\Core\View;

use App\Controller\HomeController;

// Make homepage.
Router::get('/', 'home');

// Make view and pass variables
Router::get('/profile/{id}', 'profile');

// Route with controller.
Router::get('/hello', [HomeController::class, 'show']);