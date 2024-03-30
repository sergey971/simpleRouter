<?php

namespace App;

class Router
{

    private $routers = [];

    /**
     * Добавляет маршрут в список маршрутов.
     *
     * @param string $method     HTTP метод запроса (GET, POST, PUT, DELETE и т.д.).
     * @param string $uri        URI маршрута.
     * @param array  $controller Массив, содержащий имя контроллера и метода, который будет вызван для обработки запроса.
     *                           Например: ['UserController', 'index'].
     */
    public function addRouter(string $method, string $uri, array $controller)
    {
        $this->routers[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
        ];
    }

    /**
     * Обрабатывает HTTP запрос и вызывает соответствующий контроллер и метод для обработки запроса.
     *
     * @param string $method HTTP метод запроса.
     * @param string $uri    URI запроса.
     * @return void
     */
    public function dispatch(string $method, string $uri): void
    {
        $uriParts = explode('/', $uri);

        foreach ($this->routers as $route) {

            if ($route['method'] === $method) {
                $routeUriPart = explode("/", $route['uri']);

                // Проверка количества частей URI маршрута
                if (count($uriParts) === count($routeUriPart)) {
                    $params = [];

                    foreach ($routeUriPart as $key => $part){
                        // Проверка наличия параметра в URI маршрута
                        if($part === '{part}'){
                            $params = $uriParts[$key];
                        }
                        // Сравнение частей URI маршрута с URI запроса
                        else if($part !== $uriParts[$key]){
                            continue 2;
                        }
                    }
                }

                // Вызов соответствующего метода контроллера
                $routeController = $route['controller'];
                $controller = $routeController[0];
                $methodController = $routeController[1];

                if (method_exists($controller, $methodController)) {
                    $controller = new $controller;
                    call_user_func([$controller, $methodController]);
                    return;
                }

            }
        }
    }
}
