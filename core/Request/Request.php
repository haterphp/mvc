<?php

namespace Core\Request;

use Core\Collection\Src\Traits\BaseArrayMethods;
use Core\Request\Src\RequestFunctions;

class Request {
    use RequestFunctions;

    protected $body;
    public $method;
    public $headers;

    public function __construct()
    {
        $this->body = collect($_REQUEST);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders();
    }
}