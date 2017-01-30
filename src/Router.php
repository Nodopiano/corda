<?php
Namespace Nodopiano\Corda;

use Exception;
use Nodopiano\Corda\Controller;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

class Router
{
    protected $routes = [];

    public function load($file)
    {
        $router = new RouteCollector();
        require $file;
        $router->get('{catchAll}', function() {
            http_response_code(404); 
            return view('errors/404.html');
        });
        $this->router = $router;
        return $this;
    }

    public function direct()
    {
      $dispatcher = new Dispatcher($this->router->getData());
      $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      return $response;
    }

}
