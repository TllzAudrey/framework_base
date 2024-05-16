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
    protected $requester; 

    public function __construct(){
        try {
            $this->dbh = new PDO('mysql:host='.$this->DB_HOST.';port='.$this->DB_PORT.';dbname='.$this->DB_NAME, $this->DB_USER, $this->DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if(method_exists($this, "__init")){
            $this->__init();
        }
        $this->requester = new Requester($this->table, $this->fields);
        //var_dump($this->dbh);
    }
    public function findAll($fields = "*"){
        $this->sql = $this->requester->select(['nom','prenom'])
            ->from('user');
        
        //$this->execute();        
    }

    /*     //->from("role")
            //->from(["role","user"]);
            //->from()
            //->Where(['nom'=> 'Telliez']);
            ->Where(5); // 5 spécifié que c'est une PK
            echo "<br>";
            $this->sql = $this->requester->select(['nom','prenom'])
            ->from("user")
            ->Where(['nom'=> 'Telliez']);
            echo "<br>";
            $this->sql = $this->requester->select(['nom','prenom'])
            ->from("user")
            ->Where(['nom'=> 'Telliez','prenom'=> 'Audrey']);
            //->Where(['nom'=> 'Telliez']);*/


    public function find($cond){
        $this->sql = $this->requester->select(['nom','prenom'])
            ->from('user')
            ->where($cond);
        echo '<br>';
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
        $request = $this->requester->insert($data);
        $this->sql = $request->sql;
        $this->params = $request->params;
        
        echo $this->sql;
        $this->execute();
        echo $this->dbh->lastinsertID(); 
        echo '<br>';
    }
    
        /*
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
        */

    public function update($data){
        $request = $this->requester->update($data);
        $this->sql = $request->sql;
        $this->params = $request->params;
        
        echo $this->sql;
        
        $this->execute();
        return $this->stmt->rowCount(); 
        
    }

    /*        $this->sql = "UPDATE ".$this->table." SET ";
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
            $this->sql .= $where; */


    public function delete($data){
        $request = $this->requester->delete($data);
        $this->params = $request->params;
        $this->sql = $request->sql;
        var_dump($request);
        $this->execute();
        //return $this->stmt->rowCount(); 
    }
    /*
            $this->sql = "DELETE FROM ".$this->table." WHERE id = :id";
            $this->params = $data;
            $this->execute();
            return $this->stmt->rowCount();  */
    private function execute($all = false, $mode = PDO::FETCH_ASSOC){
        $this->stmt = $this->dbh->prepare($this->sql);
        var_dump($this->stmt);
        $this->stmt->execute($this->params);
        if($all){
            return $this->stmt->fetchAll($mode);
        }else{
            return $this->stmt->fetch($mode);
        }
    } 
}