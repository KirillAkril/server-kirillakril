<?php

namespace Src\Core;

class Router
{
    private array $routes = [];

    public function add(string $route, callable $action): void
    {
        $this->routes[$route] = $action;
    }

    public function dispatch(): void
    {
        $route = $_GET['route'] ?? '/';

        if (array_key_exists($route, $this->routes)) {

            $this->routes[$route]();

            return;
        }

        echo "404 NOT FOUND";
    }
}