<?php

class Router
{
    /** 
     * @param Route[] $routes
     */
    private static $routes = [];

    public static function get(string $path, $callable)
    {
        self::register($path,$callable,'GET');
    }

    public static function register(string $path, $callable, string $method)
    {
        $newRoute = new Route($path,$callable, $method);
        self::$routes[] = $newRoute;
    }


    public function route(BaseRequest $request)
    {
        $uri = $request->path;
        $uriSegments = explode('/', trim($uri, '/'));

        $page = isset($uriSegments[1]) ? $uriSegments[1] : null;
        $parameter = isset($uriSegments[2]) ? $uriSegments[2] : null;

        if (count($uriSegments) == 1) {
            header("Location: /php-calismasi/home");
            exit;
        }

        if ($parameter == null && ($page == "fibonacci" || $page == "prime-number")) {
            echo "Parametre Girilmelidir.";
            return;
        }

        foreach (self::$routes as $route) {
            if ($route->path == $page && $route->method == $request->method) {
                call_user_func($route->callable, $parameter);
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}
