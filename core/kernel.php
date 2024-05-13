<?php
//namespace Core\Kernel;
//use Core\Routeur;

class Kernel{
    private $url_parsed;
    public function __construct(){
        //echo "kernel";
        $router = new Router();
        $router->parse();
        $this->url_parsed = $router->parse();
    }
}