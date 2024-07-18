<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = []; 
    
    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path); //sending the path entered by developer to normalized it

        $regexPath = preg_replace('#{[^/]+}#','([^/]+)',$path);

        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller ,//register the controller
            'middlewares'=> [],
            'regexPath' => $regexPath
        ]; //this will create a multi dimentional array for storing routes 
       
        
    }
    private function normalizePath(string $path): string
    {
        $path = trim($path, '/'); //remove the / character from beginnig and ending of string
        $path = "/{$path}/"; //Adding the / character from beginning and ending of a string
        $path = preg_replace('#[/]{2,}#', '/', $path); //return only one /
        return $path; //return the normalize path
    }
    public function dispatch(string $path, string $method, Container $container = null)
    { //router dispatch method
       
        $path = $this->normalizePath($path);
        $method = strtoupper($_POST['_METHOD'] ?? $method);
        foreach($this->routes as $route){
            if(!preg_match("#^{$route['regexPath']}$#",$path,$paramsValue) || $route['method'] !== $method){
                continue;
            }
            array_shift($paramsValue);
            preg_match_all('#{([^/]+)}#',$route['path'],$paramsKeys);

            $paramsKeys = $paramsKeys[1];

            $params = array_combine($paramsKeys,$paramsValue);
            [$class, $function] = $route['controller'];
            
            // $controllerInstance = new $class; //create controller class instance with string
            $controllerInstance = $container ?
                $container->resolve($class) : new $class;
                $action = fn () => $controllerInstance->{$function}($params);
                
                
                $allMiddleware = [...$route['middlewares'],...$this->middlewares];
                
                // dd($allMiddleware);
                foreach($allMiddleware as $middleware){
                    $middlewareInstance = $container ?
                    $container->resolve($middleware) : new $middleware();
                    
                    $action =  fn () =>$middlewareInstance->process($action);
                }
                
                $action();
                return;
        }
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware; //add this parameter to the middleware array
    }
    public function addRouteMiddleware(string $middleware){
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middlewares'][]=$middleware;

    }
}