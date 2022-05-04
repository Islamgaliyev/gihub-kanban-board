<?php

namespace App\Http;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class Router
{
    private ?string $controller = null;
    private ?string $action = null;
    private ?Request $request = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $controllerWithAction = explode('/', strtok($request->route, '?'));

        if (!empty($controllerWithAction[2])) {
            $this->controller = $this->getController($controllerWithAction[1]);
            $this->action = $this->getAction($controllerWithAction[2]);
            $this->start();

            return;
        }

        header('Location: ' . config('app_main_page_url'));
    }

    private function start(): void
    {
        $controllerNamespace = "App\\Http\\Controllers\\" . $this->controller;
        $controller = new $controllerNamespace(new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/../../views'),
        ]));

        if (method_exists($controller, $this->action)) {
            $controller->{$this->action}($this->request);
        }
    }

    private function getController($prefix): string
    {
        return ucfirst($prefix) . 'Controller';
    }

    private function getAction($prefix): string
    {
        return strtolower($prefix);
    }
}
