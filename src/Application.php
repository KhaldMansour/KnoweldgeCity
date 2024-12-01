<?php

namespace App;

use App\Http\Route;
use App\Http\Request;
use App\Http\Response;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;


    public function __construct()
    {
        $this->request  = new Request();
        $this->response = new Response();
        $this->route    = new Route($this->request, $this->response);
    }


    public function run()
    {
        $this->route->resolve();
    }
}
