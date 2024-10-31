<?php
class Router
{
    private static $routes = [];

    public static function get($path, $callable)
    {
        $new_route = new Route($path, $callable, 'GET');
        self::$routes[] = $new_route;
    }

    public static function post($path, $callable)
    {
        $new_route = new Route($path, $callable, 'POST');
        self::$routes[] = $new_route;
    }

    public function route($requestUri, $requestMethod)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
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
            if ($route->path == $page && $route->method == $requestMethod) {
                call_user_func($route->callable, $parameter);
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}
