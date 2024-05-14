<?php
//namespace Core\Kernel;
//use Core\Routeur;

class Kernel{
    private $url_parsed;
    public function __construct(){
        //echo "kernel";
        $router = new Router();
        //$router->parse();
        $this->url_parsed = $router->parse();
        $this->run();
    }
    private function run(){
        $ctrlname = $this->url_parsed["controller"]."Controller";
        $this->loadController($ctrlname);
        $ctrl = new $ctrlname();
        call_user_func_array(array($ctrl,$this->url_parsed['action']),$this->url_parsed['params']?$this->url_parsed['params']:array());
    }
    private function loadController($ctrlname){
        //echo CONTROLLERS.DS.$ctrl;
        if(file_exists(CONTROLLERS.DS.$ctrlname.".php")){
            require_once(CONTROLLERS.DS.$ctrlname.".php");
        }else{
            echo "Erreur 404";
        }
    }
}