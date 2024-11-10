<?php
namespace App\Core;

use App\Core\Model\BaseRequest;

class RequestParser {
    public static function parse(): BaseRequest {
        $request = new BaseRequest();

        $url = $_SERVER['REQUEST_URI'];
        $request->method = $_SERVER['REQUEST_METHOD'];
        $request->path = parse_url($url, PHP_URL_PATH);
        $request->data = json_decode(file_get_contents('php://input'), true);
        $request->requestBody = $_GET;
        return $request;
    }
}
