<?php
#[AllowDynamicProperties]
class UserController{

    public function __construct(){
        $this->loadModel("user");
    }
    private function loadModel($mdl_name){
        $file_name = $mdl_name."Model";
        if(file_exists(MODELS.DS.$file_name.".php")){
            require_once(MODELS.DS.$file_name.".php");
        }else{
            echo "Le modèle n'éxiste pas.";
        }
        $this->$mdl_name = new $file_name();
    }

    public function index($id_user){
        var_dump($this);
        $this->user->insert([
            "nom" => "Telliez",
            "prenom" => "Dominique",
            "email" => "dom@estiam.com",
            "password" => "estiam1234"

        ]);
        /*$this->user->find([
            "id" => $id_user,
            "nom" => "Telliez"
        ]);*/
    }

}