<?php

#[AllowDynamicProperties]
class userController extends Controller {


    public function index() {
        $this->set("users",$this->user->findAll([
            'relation' => 'role',
            'field' => 'id_role'
        ]));
        $this->render();
    }
    
    public function add() {
        $this->loadModel('role');
        $this->set("roles",$this->role->findAll());
        if(!empty($_POST)){
            $this->user->save($_POST);
        }
        $this->render();
    }
    public function edit($id_user) {
        $this->loadModel('role');
        $this->set("roles",$this->role->findAll());
        $this->set("user",$this->user->find($id_user));
        if(!empty($_POST)){
            $this->user->save($_POST);
        }

        $this->render();

    }

}