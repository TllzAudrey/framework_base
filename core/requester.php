<?php
class Requester {
    public $sql;
    public $params;
    private $table;
    private $fields;

    public function __construct($table, $fields){
        $this->table = $table;
        $this->fields = $fields;

    }

    public function select($fields = "*"){
        $this->sql = "SELECT ";
        if(is_array($fields)){
            foreach($fields as $k => $v){
                $this->sql .= $v.', ';
            }
        }else{
            $this->sql .= $fields;
        }
        $this->sql = substr($this->sql,0,-2);
        return $this;
    }
    public function from($table = ""){
        $this->sql .= " FROM ";

        if($table != ""){
            $this->table = $table;
        }
        if(is_array($table)){
            foreach($table as $t){
                $this->sql .= $t.', ';
            }
            $this->sql = substr($this->sql,0,-2);
        }else{
            $this->sql .= $table;
        }
        //echo $this->sql;
        return $this;
    }

    public function where($cond){
        $this->sql .= " WHERE ";

        if(is_array($cond)){
            foreach($cond as $t => $v){
                $this->sql .= $t.' = :'.$t.' AND ';
            }
            $this->sql = substr($this->sql,0,-5);
        }elseif(is_integer($cond) ){
            foreach($this->fields as $k => $v){
                if(isset($v['index'])&& $v['index'] == "PK"){
                    $this->sql.= $k.'= :'.$k;
                }
            }
        }else{
            $this->sql .= $cond;
        }
        //echo $this->sql;
        return $this;
    }

    /*SELECT *
    FROM table1
    INNER JOIN table2 ON table1.id = table2.fk_id */


    public function ijoin(){

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
        return $this;
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
        return $this;
    }

    public function delete($data){
        $this->sql = "DELETE FROM ".$this->table." WHERE id = :id";
        $this->params = $data;
        echo $this->sql;
        return $this;
    }
    public function get(){

    }
}