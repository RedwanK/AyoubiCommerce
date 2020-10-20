<?php

namespace App\Router;

require_once 'Route.php';

class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url){
        $this->url = strtok($url, '?'); /* remove GET parameters */
        $_SESSION['route'] = $this->url;
    }

    public function get($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            echo 'No route matches this name';
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        echo 'No route matches this name';

        return 1;
    }

    public function url($name, $params = []){
        if(!isset($this->namedRoutes[$name])){
            echo 'No route matches this name';
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}
