<?php

namespace App\Http;

class Route
{
    protected Request $request;
    protected Response $response;

    protected static array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }

    public static function get($route, $action)
    {
        self::$routes['get'][$route] = $action;
    }

    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public function resolve()
    {
        $path       = $this->request->path();
        $method     = $this->request->method();
        $actionData = $this->matchRoute($method, $path);

        if (!$actionData) {
            $this->response->setStatusCode(404);
            return;
        }

        $action = $actionData['action'];
        $params = $actionData['params'];

        if (is_callable($action)) {
            call_user_func_array($action, $params);
        }

        if (is_array($action)) {
            $controller = $action[0];
            $method     = $action[1];

            if (class_exists($controller)) {
                $controllerInstance = new $controller();
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                $this->response->setStatusCode(500);
                echo "Controller class '$controller' not found.";
            }
        }
    }

    protected static function matchRoute($method, $path)
    {
        foreach (self::$routes[$method] as $route => $action) {
            $routeRegex = self::convertRouteToRegex($route);

            if (preg_match($routeRegex, $path, $matches)) {
                array_shift($matches);

                return [
                    'action' => $action,
                    'params' => $matches
                ];
            }
        }

        return false;
    }

    protected static function convertRouteToRegex($route)
    {
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route);

        return '#^' . $route . '$#';
    }
}
