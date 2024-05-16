<?php
#[AllowDynamicProperties]
class Controller{
    public function __construct(){
        if(method_exists($this, "__init")){
            $this->__init();
        }
        $ctrl_name = str_replace("Controller","",get_class($this));
        echo $ctrl_name;
        $this->loadModel($ctrl_name);
    }
    private function loadModel($mdl_name){
        
        $file_name = $mdl_name."Model";
        echo MODELS.DS.$file_name.".php";
        if(file_exists(MODELS.DS.$file_name.".php")){
            require_once(MODELS.DS.$file_name.".php");
        }else{
            echo "Le modèle n'éxiste pas.";
        }
        $this->$mdl_name = new $file_name();
    }

}