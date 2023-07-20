<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected array $routes = [];

    public function get(string $path, $callback)
    {
        $this->routes[Request::REQUEST_GET][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes[Request::REQUEST_POST][$path] = $callback;
    }

    public function resolve()
    {
        $path     = $this->request->getPath();
        $method   = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        
        if (is_array($callback)) {
            Application::$APP->controller = new $callback[0];
            $callback[0]                  = Application::$APP->controller;
        }
        
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent   = $this->viewContent($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$APP->controller->layout;

        ob_start();
        include_once Application::$ROOT_DIR . '/views/layouts/' . $layout . '.php';

        return ob_get_clean();
    }

    protected function viewContent($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . '/views/' . $view . '.php';

        return ob_get_clean();  
    }
}