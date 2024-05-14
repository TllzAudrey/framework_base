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
        //echo $this->sql;
        $result = $this->fetch();
        var_dump($result);
        
    }

    /*
    UPDATE user
    SET nom = 'estiam'
    WHERE id = 5
    */
    public function update($data){
        $this->sql = "UPDATE ".$this->table." SET ";
        $this->params = $data;
        $where = "";
        foreach($data as $k => $v){
            if($k == "id"){
                $where .= " WHERE ".$k." = :".$k;
            }else{
                $this->sql .= $k." = :".$k.", ";
            }
        }
        $this->sql = substr($this->sql, 0, -2);
        $this->sql .= $where;

        echo $this->sql;
        var_dump($this->params);
        return $result = $this->executeSave();
    }
    private function executeSave(){
        $this->prepare($this->sql);
        $this->execute($this->params);
        return $this->stmt->rowCount(); 
    }
    public function delete($data){
        $this->sql = "DELETE FROM ".$this->table." WHERE id = :id";
        $this->params = $data;
        $result = $this->fetch();
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