<?php
namespace App\Core\Model;

class BaseRequest{
    public string $path;
    public string $method;
    public mixed $data;
    public array $requestBody;
}