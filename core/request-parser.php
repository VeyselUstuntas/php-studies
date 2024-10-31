<?php
require 'core/model/request.php';
class RequestParser {
    public static function parse($phpRequest): BaseRequest {
        $request = new BaseRequest();
        $request->uri = parse_url($phpRequest['REQUEST_URI'], PHP_URL_PATH);
        $request->method = $phpRequest['REQUEST_METHOD'];
        return $request;
    }
}
