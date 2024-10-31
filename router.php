<?php
class Router {
    private static $routes = [];

    public static function register(Route $route) {
        self::$routes[] = $route;
    }

    public function route($requestUri) {
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
            if ($route->path == $page) {
                call_user_func($route->callable, $parameter);
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}


