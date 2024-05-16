<?php
#[AllowDynamicProperties]
class UserController extends Controller{


    /*private function loadModel($mdl_name){
        

        $file_name = $mdl_name."Model";
        if(file_exists(MODELS.DS.$file_name.".php")){
            require_once(MODELS.DS.$file_name.".php");
        }else{
            echo "Le modèle n'éxiste pas.";
        }
        $this->$mdl_name = new $file_name();
    }*/

    private function render($view){
        ob_start();
        extract($this->vars);
        if(file_exists(VIEW.DS.$view.".php")){
            require_once(VIEW.DS.$view.".php");
        }else{
            echo "La view n'éxiste pas.";
        }
        $content_for_layout = ob_get_contents();
        ob_end_clean();
        if(file_exists(TPLS.DS.$this->tpl.".php")){
            require_once(TPLS.DS.$this->tpl.".php");
        }else{
            echo "La view n'éxiste pas.";
        }

    }

    private function set($name,$var){
            $this->vars[$name]= $var;
        //var_dump($this->vars);
    }


    private function css($ar){
        foreach($ar as $v){
            echo '<link rel="stylesheet" href="\\assets\css\\'.$v.'">';
        }
        //var_dump($ar);
    }

    
    private function js($ar){
        foreach($ar as $v){
            echo '<script src="\\assets\js\\'.$v.'"></script>';
        }
        //var_dump($ar);
    }



    public function index($id_user){
        var_dump($this->user);
    }
}
