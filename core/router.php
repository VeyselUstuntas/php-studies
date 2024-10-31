<?php

class Router
{
    /** 
     * @param Route[] $routes
     */
    private static $routes = [];

    public static function get(string $path, $callable)
    {
        self::register(new Route($path, $callable, 'GET'));
    }

    public static function register(Route $new_route)
    {
        self::$routes[] = $new_route;
    }


    public function route(BaseRequest $request)
    {
        $uri = $request->uri;
        $uriSegments = explode('/', trim($uri, '/'));

        $page = isset($uriSegments[1]) ? $uriSegments[1] : null;
        $parameter = isset($uriSegments[2]) ? $uriSegments[2] : null;

        if ($page === null) {
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
