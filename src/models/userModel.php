<?php

class userModel extends Model {
    private $dbh = null;
    private $sql;

    

    public function __init(){
        $this->table = "user";
        $this->fields = [
            "id"=>[
                "type"=>"int",
                "index" => "PK",
                "size" => 11
            ], 
            "nom"=>[
                "type"=>"varchar",
                "size" => 60
            ], 
            "prenom"=>[
                "type"=>"varchar",
                "size" => 60
            ], 
            "email"=>[
                "type"=>"varchar",
                "size" => 60
            ], 
            "password"=>[
                "type"=>"varchar",
                "size" => 60
            ] ];
    }

}