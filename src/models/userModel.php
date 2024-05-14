<?php

class UserModel{
    public function __construct(){
        echo "user controller";
    }
    public function index($id_user){
        echo $id_user;
    }

}