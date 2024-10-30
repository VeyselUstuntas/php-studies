<?php
class Router {
    private $routes = [];

    public function register(Route $route) {
        $this->routes[] = $route;
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

        foreach ($this->routes as $route) {
            if ($route->path === $page) {
                call_user_func($route->callable, $parameter);
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}


