<?php

class UserModel{
    private $table = "user";
    private $dbh = null;
    private $stmt;
    private $sql;
    private $params ;
    
    public function __construct(){
        $user = "root";
        $pass = "";
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=framework_base', $user, $pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        //var_dump($this->dbh);
    }

    
    public function findAll(){
        $this->sql = "SELECT * FROM ".$this->table;
        $result = $this->fetchAll();
        //var_dump($this->dbh);
        var_dump($result);
    }

    public function find($cond){
        $this->sql = "SELECT * FROM ".$this->table." WHERE ";
        $this->params = $cond;

        foreach($cond as $key => $value){
            $this->sql .= $key." = :".$key;
            if(count($cond)>1){
                $this->sql .= " AND ";
            }
        }

        $this->sql = substr($this->sql, 0, -4);
        //$result = $this->fetchAll();
        $result = $this->fetch();
        
        var_dump($result);
    }

    public function insert($data){
        $this->sql = "INSERT INTO ".$this->table." (";
        $this->params = $data;
        $values = "";
        foreach($data as $k => $v){
            $this->sql .= $k.", ";
            $values .= ":".$k.", ";
        }
        $this->sql = substr($this->sql, 0, -2);
        $values = substr($values, 0, -2);
        $this->sql .= ") VALUES(".$values.")";

        $result = $this->fetch();
        var_dump($result);
    }

    private function prepare(){
        $this->stmt = $this->dbh->prepare($this->sql);
    }
    private function execute(){
        $this->stmt->execute($this->params);
    }
    private function fetchAll($mode = PDO::FETCH_ASSOC){
        $this->prepare($this->sql);
        $this->execute();
        return $this->stmt->fetchAll($mode); // PDO::FETCH_ASSOC pour voir le nom des colones
    }
    private function fetch($mode = PDO::FETCH_ASSOC){
        $this->prepare($this->sql);
        $this->execute();
        return $this->stmt->fetch($mode); // PDO::FETCH_ASSOC pour voir le nom des colones
    }

}