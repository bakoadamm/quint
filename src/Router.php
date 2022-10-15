<?php

namespace Quint;

class Router {

    /**
     * @var string
     */
    private $method;

    /**
     * Router constructor.
     */
    public function __construct(){
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @var array[]
     */
    private $routes = [
        'get'       => [],
        'post'      => [],
        'put'       => [],
        'delete'    => []
    ];

    /**
     * @var array
     */
    private $protectedRoutes = [];

    /**
     * @param $pattern
     * @param $handler
     * @param bool $auth
     * @return $this
     */
    public function get($pattern, $handler) {
        if($this->method === 'get') {
            $this->routes['get'][$pattern] = $handler;
            return $this;
        }
    }

    /**
     * @param $pattern
     * @param $handler
     * @param bool $auth
     * @return $this
     */
    public function post($pattern, $handler) {
        if($this->method === 'post') {
            $this->routes['post'][$pattern] = $handler;
            return $this;
        }
    }

    /**
     * @param $pattern
     * @param $handler
     * @param bool $auth
     * @return $this
     */
    public function put($pattern, $handler) {
        if($this->method === 'put') {
            $this->routes['put'][$pattern] = $handler;
            return $this;
        }
    }

    /**
     * @param $pattern
     * @param $handler
     * @param bool $auth
     * @return $this
     */
    public function delete($pattern, $handler) {
        if($this->method === 'delete') {
            $this->routes['delete'][$pattern] = $handler;
            return $this;
        }
    }

    /**
     * @param Request $request
     * @return array|false
     */
    public function match(Request $request) {

        $method = strtolower($request->getMethod());

        if ( ! isset($this->routes[$method])) {
            return false;
        }

        $path = $request->getPath();

        foreach ($this->routes[$method] as $pattern => $handler) {
            $pattern = $this->replace($pattern);
            if (preg_match("%^" . $pattern . "$%", $path, $matches)) {
                return [$handler, $matches];
            }
        }
        return false;
    }

    /**
     * @param $route
     * @return string|string[]|null
     */
    private function replace($route) {
        return preg_replace_callback('%\{{1}(.*?)\}{1}%',function($match) {
            return '(?<' . $match[1] . '>[\w]+)';
        }, $route);
    }

    /**
     * @return array
     */
    public function getProtectedRoutes() {
        return $this->protectedRoutes;
    }
}
