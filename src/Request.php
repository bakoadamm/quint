<?php

namespace Quint;

class Request {

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $protectedRoutes;

    /**
     * @var array|false|string
     */
    private $headers;

    public function __construct($method, $path, array $protectedRoutes) {
        $this->protectedRoutes = $protectedRoutes;
        $this->method = $method;
        $this->headers = getallheaders();
        $this->path = $path;
        $_SESSION['path'] = $path;

        $this->setBody();
    }

    public function getMethod() {
        return $this->method;
    }

    public function getPath() {
        return $this->path;
    }

    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @param $key
     * @return string|null
     */
    public function header($key) {
        return isset($this->headers[$key]) ? $this->headers[$key] : null;
    }

    public function setBody() {
        $this->body = null;
        if ($this->method === 'get') {
            return false;
        }

        $this->body = json_decode(file_get_contents('php://input'));

        if($this->body != null || $this->body != '') {
            return false;
        }

        $this->body = isset($_POST) ? (object)$_POST : null;
        return true;
    }

    public function getRawBody() {
        return $this->body;
    }

    public function getRequestBody($objectName) {
        if ( ! class_exists($objectName)) {
            throw new \Exception("The request class '$objectName' does not exist");
        }

        $requestClass = new $objectName();
        foreach($requestClass as $key => $value)  {
            //dd($requestClass->validate()); TODO: validate
            $requestClass->{$key} = property_exists($this->body, $key) ? $this->body->{$key} : null;
        }

        return $requestClass;
    }

    public function get($key) {
        return property_exists($this->body, $key) ? $this->body->{$key} : null;
    }

    /**
     * @return array
     */
    public function getProtectedRoutes() {
        return $this->protectedRoutes;
    }
}
