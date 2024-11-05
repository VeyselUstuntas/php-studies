<?php
require 'core/model/request.php';
class RequestParser {
    public static function parse($phpRequest): BaseRequest {
        $request = new BaseRequest();

        $url = $phpRequest['REQUEST_URI'];
        $request->method = $phpRequest['REQUEST_METHOD'];
        $request->path = parse_url($url, PHP_URL_PATH);
        $request->data = json_decode(file_get_contents('php://input'), true);
        return $request;
    }
}
