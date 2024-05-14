<?php
//namespace Core\Router;
class Router{
    //traiter le cas ou il n'y a pas action
    //traiter le cas ou il n'y a pas controller

    private $url;
    private $url_parsed;
    public function parse(){
        // récupérer la requête 
        //parser la requête et définir selon le shémas suivant :
        //controller/action/[param1/param2]
        $this->url = $_SERVER['PATH_INFO'];
        
        $this->url = array_slice(explode("/", $this->url),1);
        

        $this->url_parsed['controller'] =$this->url[0];
        $this->url_parsed['action'] =$this->url[1];

        $this->url =array_slice($this->url,2);
        if(count($this->url)>0){
            $this->url_parsed['params']=$this->url;
        }else{
            $this->url_parsed['params'][]="";
        }
        //var_dump($this->url_parsed);
        return $this->url_parsed;
        
        //echo $url;
        //echo "toto";
    }
}