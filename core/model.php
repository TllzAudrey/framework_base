<?php

class Model{

    private $DB_USER = "root";
    private $DB_HOST = "localhost";
    private $DB_PASS = "";
    private $DB_NAME = "framework_base";
    private $DB_PORT = 3306;

    private $dbh ;
    private $sql;
    private $stmt;
    private $params;
    protected $table;
    protected $fields;

    public function __construct(){
        try {
            $this->dbh = new PDO('mysql:host='.$this->DB_HOST.';port='.$this->DB_PORT.';dbname='.$this->DB_NAME, $this->DB_USER, $this->DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if(method_exists($this, "__init")){
            $this->__init();
        }
        //var_dump($this->dbh);
    }
    public function findAll(){
        $this->sql = "SELECT * FROM ".$this->table;
        return $this->execute();
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
        return $this->execute(true);
    }

    public function save($data){
        $data_key = array_keys($data);
        foreach($data_key as $k){
            if(isset($this->fields[$k]['index'])&& $this->fields[$k]['index'] == "PK"){
                echo "oui" ;
                return $this->update($data);
            }else{
                echo "non" ;
                return $this->insert($data);
            }
        }
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
        $this->execute();
        return $this->dbh->lastinsertID(); 
        
    }

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
        
        $this->execute();
        return $this->stmt->rowCount(); 
        
    }

    public function delete($data){
        $this->sql = "DELETE FROM ".$this->table." WHERE id = :id";
        $this->params = $data;
        $this->execute();
        return $this->stmt->rowCount(); 
    }

    private function execute($all = false, $mode = PDO::FETCH_ASSOC){
        $this->stmt = $this->dbh->prepare($this->sql);
        $this->stmt->execute($this->params);
        if($all){
            return $this->stmt->fetchAll($mode);
        }else{
            return $this->stmt->fetch($mode);
        }
    } 
}