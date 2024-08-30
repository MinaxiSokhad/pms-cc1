<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;
    private Container $container;
    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router(); // instance of Router class
        $this->container = new Container(); // instance of container class 

        if ($containerDefinitionsPath) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions); //use container class method
        }
    }
    public function run()
    {
        //echo "Application is running";
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //before router dispatching grab the path
        $method = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch($path, $method, $this->container);

        //call router dispatch method return path like /GET or phpiggy.local/dgdgasfg -> output /dgdgasfg/GET
    }
    public function get(string $path, array $controller)
    {

        $this->router->add('GET', $path, $controller); //add http method to our routes -> GET
        return $this;
    }
    public function post(string $path, array $controller)
    {

        $this->router->add('POST', $path, $controller);
        return $this;
    }
    public function delete(string $path, array $controller)
    {

        $this->router->add("DELETE", $path, $controller);
        return $this;
    }
    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware); //add  middleware method in router
    }
    public function add(string $middleware)
    {
        $this->router->addRouteMiddleware($middleware);
    }
    public function setErrorHandler(array $controller)
    {
        $this->router->setErrorHandler($controller);
    }
}