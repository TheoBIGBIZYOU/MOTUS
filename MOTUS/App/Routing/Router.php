<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\Controller;
use App\Controller\Homepage;
use App\Controller\Error404;
use App\Controller\NewGame;
use App\Controller\Victoire;

class Router
{
    private string $path;

    private ?Router $router = null;

    private array $routes = [
        '/' => Homepage::class,
        '/404' => Error404::class,
        '/retry' => NewGame::class,
        '/victoire' => Victoire::class
    ];

    public function __construct()
    {
        $this->path = $_SERVER['PATH_INFO'] ?? '/';
    }

    public function getController(): void
    {
        $controllerClass = $this->routes[$this->path] ?? $this->routes['/404'];
        $controller = new $controllerClass();

        if (!$controller instanceof Controller) {
            throw new \LogicException("controller $controllerClass should implement ".Controller::class);
        }

        $controller->render();
    }
}
